<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function checkout()
    {
        $data = [
            'total' => Cart::total(),
        ];

        return view('web.page.checkout', $data);
    }
}
