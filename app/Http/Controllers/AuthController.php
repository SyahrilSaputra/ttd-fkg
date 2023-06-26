<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\CheckLoginRequest;

class AuthController extends Controller
{
    private $service;
    public function __construct()
    {
        $this->service = new AuthService;
    }
    public function login()
    {
        return view('auth.login');
    }
    public function checkLogin(CheckLoginRequest $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }
        return redirect()->route('login')->with('status', 'Username dan Password Tidak Cocok');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
