<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function goLogin(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'password' => ['required','min:8'],
        ]);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect(route('panel.dashboard'));
        } else {
            return redirect(route('login'))->with('fail', 'Email or Password was wrong');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
