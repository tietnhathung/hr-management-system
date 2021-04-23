<?php

namespace Core\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users|min:3|max:50',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|nullable|email|regex:/^\S+@\S+\.\S+$/',
            'mobile' => 'nullable|max:10|regex:/(0)[0-9]{9}/'
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Please enter a username!',
            'username.min' => 'username length must be greater than 6',
            'username.max' => 'The username length cannot be greater than 50',
            'username.unique' => 'Username already exists',
            'password.required' => 'Please enter a password',
            'password.confirmed' => 'Please enter confirm password',
            'password.min' => 'Password length must be greater than 6',
            'email.required' => 'Please enter an email',
            'email.regex' => 'Please enter correct email format',
            'email.email' => 'Please enter correct email format',
            'mobile.regex' => 'Please enter correct mobile format',
            'mobile.max' => 'Please enter correct mobile format'
        ];
    }
    public function attributes()
    {
        return [
            'username' => 'Tên người dùng ',
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu ',
            'mobile' => 'Số điện thoại ',

        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
