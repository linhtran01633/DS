<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('login_admin');
    }

    public function login_admin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        return back()->withInput()->withErrors(['status' => __('login is incorrect.')]);
    }

    public function logout_admin(Request $request)
    {
        try{
            if (Auth::guard('web')->check()) {
                Auth::logout();
            }

            return view('login_admin');
        } catch (Exception $e){
            return view('login_admin');
        }
    }
}
