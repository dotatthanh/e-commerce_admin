<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'phone_number' => ['nullable', 'size:10'],
            'address' => ['nullable', 'max:255'],
            'birthday' => ['nullable', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên là trường bắt buộc.',
            'name.max' => 'Họ và tên không được dài quá :max ký tự.',
            'name.string' => 'Họ và tên phải là một chuỗi.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email chưa đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.string' => 'Email phải là một chuỗi.',
            'email.max' => 'Email không được dài quá :max ký tự.',
            'email.lowercase' => 'Email chỉ được phép sử dụng chữ cái thường.',
            'password.required' => 'Mật khẩu là trường bắt buộc.',
            'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp.',
            'phone_number.size' => 'Số điện thoại phải là :size số.',
            'address.max' => 'Địa chỉ không được dài quá :max ký tự.',
            'birthday.date' => 'Ngày sinh không đúng định dạng.',
        ];
    }
}
