<?php
namespace Modules\Core\Http\Requests\Personal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
{
    public function rules(Request $request)
    {
        return [
            'fullname' => 'required',
            'email' => 'sometimes|nullable|email'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Bạn phải nhập Họ tên!',
            'email.email' => 'Bạn phải nhập Email đúng định dạng!'
        ];
    }
}
