<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
    public function getloginAdmin()
    {
        return view('admin.auth.login');
    }

    public function postloginAdmin(Request $request)
    {
        $login = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($login)) {

            return redirect()->to('api-admin');
        }
        return redirect()->back();
    }

    public function getLogoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->to('/');
    }
}
