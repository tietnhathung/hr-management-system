<?php

namespace Core\AjaxUpload\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class AjaxUploadController extends Controller
{
    function index()
    {
        return view('ajax_upload');
    }

    function action(Request $request)
    {
        $messages = [
            'select_file.required' => 'Vui lòng chọn file cần upload!'
        ];
        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], $messages);

        $validation->setAttributeNames(["select_file" => "File Upload"]);

        if($validation->passes())
        {
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/images'), $new_name);
            return response()->json([
                'message'   => 'Image Upload Successfully',
                'uploaded_image' => '<img src="/uploads/images/'.$new_name.'" class="img-thumbnail" width="200" />',
                'class_name'  => 'alert-success',
                'image_path' => '/uploads/images/'.$new_name.''
            ]);
        }
        else
        {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger',
                'image_path' => ''
            ]);
        }
    }

    function uploadAvatar(Request $request)
    {
        $messages = [
            'select_file.required' => 'Vui lòng chọn file cần upload!'
        ];
        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], $messages);

        $validation->setAttributeNames(["select_file" => "File Upload"]);

        if($validation->passes())
        {
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $folder = "/" . Date::now()->format("Ymd") . "/";
            $image->move(env('IMAGE_FOLDER_AVATAR') . $folder, $new_name);
            return response()->json([
                'message'   => 'Image Upload Successfully',
                'uploaded_image' => '<img src="'. env('URL_IMAGE') . env('IMAGE_URL_AVATAR') . $folder . $new_name.'" class="img-thumbnail" width="200" />',
                'class_name'  => 'alert-success',
                'image_path' => env('IMAGE_URL_AVATAR') . $folder . $new_name . ''
            ]);
        }
        else
        {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger',
                'image_path' => ''
            ]);
        }
    }
}
