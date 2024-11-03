<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function changePassword()
    {
        $data = [
            'user' => auth()->guard('web')->user(),
        ];

        return view('web.page.change-password', $data);
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        auth()->guard('web')->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('alert-success', 'Đổi mật khẩu thành công!');
    }

    public function profile()
    {
        $user = auth()->guard('web')->user();
        if (! $user) {
            return redirect(route('web.login'));
        }

        return view('web.page.profile', compact('user'));
    }

    public function purchaseHistory()
    {
        $data = [
            'data' => auth()->guard('web')->user()->orders,
        ];

        return view('web.page.purchase-history', $data);
    }

    public function orderDetail(Order $order)
    {
        $order->load('orderDetails');
        $data = $order->orderDetails()->with('productVariant.product')->paginate(10);

        $data = [
            'order' => $order,
            'data' => $data,
        ];

        return view('web.page.order-detail', $data);
    }
}
