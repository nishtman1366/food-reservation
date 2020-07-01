<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.home');
    }

    public function login(Request $request)
    {
        return view('pages.login');
    }

    public function signIn(Request $request)
    {
        if (Auth::attempt($request->only(['username', 'password']))) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
