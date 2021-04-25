<?php

namespace Core\AjaxUpload\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }


    public function attributes()
    {
        return [
            //
            'select_file' => 'File Upload'
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
