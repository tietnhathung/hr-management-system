<?php

namespace Core\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{

    public function changeProfile() {
        $obj = Auth::user();
        return view('user::changeProfile', compact('obj'));
    }

    public function updateProfile(Request $request) {
        $obj = Auth::user();
        $obj->fullname = $request->fullname;
        $obj->address = $request->address;
        $obj->mobile = $request->mobile;
        if ($request->user_avatar != "")
            $obj->avatar = $request->user_avatar;
        $obj->save();
        return redirect ( route("user.profile"))->with ( "flash-message", "Cập nhật thông tin thành công" );

    }

    public function profile() {
        $user = Auth::user();
        if (!$user)
            return redirect("/")->with("error-message", "Dữ liệu không tồn tại hoặc không được phép truy cập.");

//        $schedCountData = $user->schedules()->where("IsApproved", 1)
//            ->select(DB::raw("SUM(IF(Status=1, 1, 0)) cFinished, SUM(IF((DATE(EndDate)<=DATE(SYSDATE()) && Status=0), 1, 0)) cExpired,  SUM(IF((DATE(EndDate)>=DATE(SYSDATE()) && (Status=0) ), 1, 0)) cPlan "))
//            ->first();

//        $sched['Finished'] = $user->schedules()->where("IsApproved", 1)->where("Status", 1)->take(10)->get();
//        $sched['Expired'] = $user->schedules()->where("IsApproved", 1)->where("Status", 0)->whereRaw("DATE(EndDate)<DATE(SYSDATE())")->take(10)->get();
//        $sched['Plan'] = $user->schedules()->where("IsApproved", 1)->where("Status", 0)->whereRaw("DATE(EndDate)>=DATE(SYSDATE())")->take(10)->get();
        return view('user::showProfile', compact('user'));
    }

    public function changePassword() {
        $obj = Auth::user();
        return view('user::changePassword', compact('obj'));
    }

    public function updatePassword(Request $request) {
        $obj = Auth::user();

        $rules = array(
            'old_password'            => 'required',
            'new_password'       => 'required|confirmed|different:old_password',
            'new_password_confirmation' => 'required|different:old_password'
        );

        $attributes = array (
            'old_password' => 'Mật khẩu cũ',
            'new_password' => 'Mật khẩu mới',
            'new_password_confirmation'=> 'Xác nhận mật khẩu'
        );

        $validator = Validator::make(Input::all(), $rules, [], $attributes);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!Hash::check($request->old_password, $obj->password)) {
            return Redirect::back()->with('error-message', 'Mật khẩu cũ không đúng.');
        } else {
            $obj->fill([
            'password' => Hash::make($request->new_password)
            ])->save();

            return Redirect::back()->with('flash-message', 'Thay đổi mật khẩu thành công.');
        }
    }
}
