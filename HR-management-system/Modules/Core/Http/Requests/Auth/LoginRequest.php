<?php
namespace Modules\Core\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Bạn phải nhập Tên đăng nhập!',
            'password.required' => 'Bạn phải nhập Mật khẩu!'
        ];
    }
}
