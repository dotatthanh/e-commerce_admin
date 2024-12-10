<?php

namespace App\Http\Controllers\Web;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductVariant;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productVariant = ProductVariant::with('product')->find($request->product_variant_id);
        $product = $productVariant->product;

        if ($productVariant->quantity == 0) {
            return redirect()->back()->with('alert-error', 'Sản phẩm ' . $product->name . ' hiện tại đã hết hàng!');
        }

        Cart::add([
            'id' => $request->product_variant_id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price - ($product->price * $product->sale / 100),
            'weight' => 0,
            'options' => [
                'img' => $product->file_path,
            ],
        ]);

        return redirect()->back()->with('alert-success', 'Thêm sản phẩm ' . $product->name . ' vào giỏ hàng thành công!');
    }

    public function cart()
    {
        $data = [
            'total' => Cart::total(),
        ];

        return view('web.page.cart', $data);
    }

    public function updateCart(Request $request)
    {
        foreach ($request->cart as $rowid => $cart) {
            $productVariant = ProductVariant::with('product')->find($cart['product_variant_id']);
            $product = $productVariant->product;
            if ($cart['qty'] > $productVariant->quantity) {
                return redirect()->back()->with('alert-error', 'Sản phẩm ' . $product->name . ' cửa hàng chỉ còn lại ' . $productVariant->quantity . ' sản phẩm!');
            }
            Cart::update($rowid, $cart['qty']);
        }

        return redirect()->back()->with('alert-success', 'Cập nhật giỏ hàng thành công');
    }

    public function deleteItemCart($rowid)
    {
        Cart::remove($rowid);

        return $this->responseSuccess(Response::HTTP_OK, [], 'Đã xóa sản phẩm trong đơn hàng');
    }

    public function viewCheckout()
    {
        if (Cart::count() < 1) {
            return redirect()->back()->with('alert-error', 'Giỏ hàng của bạn không có sản phẩm!');
        }

        $data = [
            'total' => Cart::total(),
        ];

        return view('web.page.checkout', $data);
    }

    public function checkout(Request $request)
    {
        if (Cart::count() < 1) {
            return redirect()->back()->with('alert-error', 'Giỏ hàng của bạn không có sản phẩm!');
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'code' => 'PD',
                'customer_id' => auth()->guard('web')->user()->id,
                'status' => OrderStatus::PENDING,
                'payment_method' => $request->payment_method,
                'total_money' => 0,
                'discount' => 0,
                'discount_code_id' => null,
            ]);

            $total_money = 0;
            $cart = Cart::content();
            // Tạo chi tiết đơn hàng
            foreach ($cart as $item) {
                $productVariant = ProductVariant::with('product')->find($item->id);
                $product = $productVariant->product;
                if ($item->qty > $productVariant->quantity) {
                    return redirect()->back()->with('alert-error', 'Sản phẩm ' . $product->name . ' cửa hàng chỉ còn lại ' . $productVariant->quantity . ' sản phẩm!');
                }

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $product->price,
                    'sale' => $product->sale ?? 0,
                    'total_money' => $item->qty * $item->price,
                    'discount' => $item->qty * $product->price * $product->sale / 100,
                ]);

                $productVariant->update([
                    'quantity' => $productVariant->quantity - $item->qty,
                ]);

                // Thành tiền 1 sản phẩm
                $total = ($item->qty * $product->price) - ($item->qty * $product->price * $productVariant->sale / 100);
                $total_money += $total;
            }

            $order->update([
                'total_money' => $total_money,
                'code' => 'PD' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
            ]);

            if ($request->payment_method == "Thanh toán VnPay") {
                $vnpayUrl = $this->paymentVnpay([
                    'order_id' => $order->id,
                    'amount' => convertTotalToNumber(Cart::total()),
                ]);
                Cart::destroy();
                DB::commit();
                return redirect($vnpayUrl);
            }

            Cart::destroy();
            DB::commit();

            return redirect()->route('web.purchase-history')->with('alert-success', 'Đặt hàng thành công! Cảm ơn quý khách hàng đã tin tưởng và sử dụng dịch vụ của chúng tôi');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);

            return redirect()->back()->with('alert-error', 'Có lỗi xảy ra! Đặt hàng thất bại!');
        }
    }

    public function paymentSuccess(Request $request)
    {
        $data = $request->all();
        switch ($data['vnp_ResponseCode']) {
            case '00':
                $order = Order::find($data['vnp_TxnRef']);
                $order->update(['payment_status' => 'Đã thanh toán']);
                return redirect()->route('web.home')->with('success', 'Giao dịch thành công');
            case '07':
                return redirect()->route('web.home')->with('error', 'Trừ tiền thành công. Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường).');
            case '09':
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng.');
            case '10':
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần.');
            case '11':
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Đã hết hạn chờ thanh toán. Vui lòng thực hiện lại giao dịch.');
            case '12':
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Thẻ/Tài khoản của khách hàng bị khóa.');
            case '13':
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Nhập sai mật khẩu xác thực giao dịch (OTP). Vui lòng thực hiện lại giao dịch.');
            case '24':
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Khách hàng đã hủy giao dịch.');
            case '51':
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Tài khoản không đủ số dư.');
            case '65':
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Tài khoản đã vượt quá hạn mức giao dịch trong ngày.');
            case '75':
                return redirect()->route('web.home')->with('error', 'Ngân hàng thanh toán đang bảo trì. Vui lòng thử lại sau.');
            case '79':
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Nhập sai mật khẩu thanh toán quá số lần quy định. Vui lòng thực hiện lại giao dịch.');
            case '99':
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Lỗi không xác định.');
            default:
                return redirect()->route('web.home')->with('error', 'Giao dịch không thành công: Lỗi không rõ nguyên nhân.');
        }
    }

    private function paymentVnpay($data_payment)
    {
        $vnp_TmnCode = env('VNP_TMNCODE'); //Mã website tại VNPAY 
        $vnp_HashSecret = env('VNP_HASH_SECRET'); //Chuỗi bí mật
        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('VNP_RETURN_URL');

        $vnp_TxnRef = $data_payment['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán.';
        $vnp_OrderType = 'other';
        $vnp_Amount = $data_payment['amount'] * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }
}
