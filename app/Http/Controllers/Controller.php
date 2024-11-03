<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use App\Models\Category;

abstract class Controller
{
    // public function __construct() {
    //     if (auth()->guard('web')->check()) {
    //         $cart = Cart::content();
    //         View::share('cart', $cart);
    //     }
    //     $menu = Category::where('is_show', getConst('isShow')[1])->get();
    //     View::share('menu', $menu);
    // }

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
