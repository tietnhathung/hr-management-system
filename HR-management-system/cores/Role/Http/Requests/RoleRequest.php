<?php

namespace Core\Role\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|unique:roles',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter user groups name!',
            'name.unique' => 'User groups name already exists!',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'User groups name',
   
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
