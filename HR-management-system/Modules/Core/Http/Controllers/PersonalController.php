<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Helpers\Logging;
use Modules\Core\Http\Requests\Personal\UpdateRequest;
use Modules\Core\Http\Requests\Personal\ChangePasswordRequest;

class PersonalController extends Controller
{
    private $baseView = 'core::personal.';

    public function edit()
    {
        $title = 'Thông tin cá nhân';

        \SEO::setTitle($title);

        $obj = Auth::user();
        if (!$obj) {
            return abort(404);
        }

        return view($this->baseView . __FUNCTION__, compact('title',  'obj'));
    }

    public function update(UpdateRequest $request)
    {
        dd("ss");
        $user = \Auth::user();

        try {
            $data = $request->all();
            $user->fullname = $data["fullname"];
            $user->email = $data["email"];
            $user->save();

            $route = route('personal.edit');

            Logging::LogInfo('Sửa thông tin cá nhân thành công.', 'id = ' . $user->id);

            return redirect($route)->with('flash-message', 'Lưu thông tin cá nhân thành công!');
        } catch (\Exception $e) {
            Logging::LogError('Sửa thông tin cá nhân lỗi.', 'id = ' . $user->id . '. Exception = ' . $e->getMessage());

            return redirect()->back()->withErrors('Lưu thông tin cá nhân lỗi!');
        }
    }

    public function changePasswordEdit()
    {
        $title = 'Đổi mật khẩu';

        \SEO::setTitle($title);

        return view($this->baseView . __FUNCTION__, compact('title'));
    }

    public function changePasswordUpdate(ChangePasswordRequest $request)
    {
        $user = \Auth::user();

        try {
            $data = $request->all();
            $user->password = \Hash::make($data['newPassword']);
            $user->save();

            $route = route('personal.changePasswordEdit');

            Logging::LogInfo('Sửa mật khẩu thành công.', 'id = ' . $user->id);

            return redirect($route)->with('flash-message', 'Lưu mật khẩu thành công!');
        } catch (\Exception $e) {
            Logging::LogError('Sửa mật khẩu lỗi.', 'id = ' . $user->id . '. Exception = ' . $e->getMessage());

            return redirect()->back()->withErrors('Lưu mật khẩu lỗi!');
        }
    }
}
