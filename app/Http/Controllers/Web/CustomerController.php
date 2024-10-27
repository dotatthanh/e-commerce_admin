<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function  changePassword()
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
}
