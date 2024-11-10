<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\View;

abstract class Controller
{
    public function __construct()
    {
        // if (auth()->guard('web')->check()) {
        //     $cart = Cart::content();
        //     View::share('cart', $cart);
        // }
        $cart = Cart::content();
        View::share('cart', $cart);
        // dd($cart);
        // dd($cart->count());

        $categories = Category::isShow()->limit(8)->get();
        View::share('categories', $categories);
    }

    public function responseError($status, $data, $message = '')
    {
        $response = [
            'status' => 'error',
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, $status);
    }

    public function responseSuccess($status, $data, $message = '')
    {
        $response = [
            'status' => 'success',
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, $status);
    }
}
