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

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productVariant = ProductVariant::with('product')->find($request->product_variant_id);
        $product = $productVariant->product;

        if ($productVariant->quantity == 0) {
            return redirect()->back()->with('alert-error', 'Sản phẩm '.$product->name.' hiện tại đã hết hàng!');
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

        return redirect()->back()->with('alert-success', 'Thêm sản phẩm '.$product->name.' vào giỏ hàng thành công!');
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
                return redirect()->back()->with('alert-error', 'Sản phẩm '.$product->name.' cửa hàng chỉ còn lại '.$productVariant->quantity.' sản phẩm!');
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
            if ($request->payment_method == 'Thanh toán khi nhận hàng') {
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
                        return redirect()->back()->with('alert-error', 'Sản phẩm '.$product->name.' cửa hàng chỉ còn lại '.$productVariant->quantity.' sản phẩm!');
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
                    'code' => 'PD'.str_pad($order->id, 6, '0', STR_PAD_LEFT),
                ]);
            }

            Cart::destroy();
            DB::commit();

            return redirect()->route('web.purchase-history')->with('alert-success', 'Đặt hàng thành công! Cảm ơn quý khách hàng đã tin tưởng và sử dụng dịch vụ của chúng tôi');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Có lỗi xảy ra! Đặt hàng thất bại!');
        }
    }
}
