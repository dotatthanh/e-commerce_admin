<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredCustomerController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('web.page.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterCustomerRequest $request): RedirectResponse
    {
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $customer->update([
            'code' => 'KH'.$customer->id,
        ]);

        // event(new Registered($customer));

        Auth::guard('web')->login($customer);

        return redirect(route('web.login', absolute: false));
    }
}
