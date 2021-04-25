<?php
namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Core\Helpers\Logging;
use Modules\Core\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    private $baseView = 'core::auth.';

    public function index()
    {
        \SEO::setTitle('Đăng nhập');

        return view($this->baseView . __FUNCTION__);
    }

    public function login(LoginRequest $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];
        $lastUrl = $request->query('lastUrl');
        if (\Auth::attempt($data)) {
            Logging::LogInfo('Đăng nhập thành công.', 'username = ' . $data['username']);
            if ($lastUrl && \Str::of($lastUrl)->startsWith('/')) {
                return redirect()->to($lastUrl);
            } else {
                return redirect()->route('index');
            }
        } else {
            Logging::LogError('Đăng nhập lỗi.', 'username = ' . $data['username']);

            if ($lastUrl && \Str::of($lastUrl)->startsWith('/')) {
                $route = route('auth.login', ['lastUrl' => $lastUrl]);
            } else {
                $route = route('auth.login');
            }

            return redirect($route)->withErrors('Tên đăng nhập hoặc Mật khẩu không đúng!');
        }
    }

    public function logout(Request $request)
    {
        Logging::LogInfo('Đăng xuất thành công.', 'id = ' . \Auth::guard()->user()->id);
        Session::flush();
        \Auth::logout();
        return redirect()->route('auth.login');
    }
}
