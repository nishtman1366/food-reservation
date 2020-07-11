<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $yesterday = Carbon::yesterday();
        $user = Auth::user();
        $jYesterday = Jalalian::forge($yesterday)->format('Y/m/d');
        $poll = Poll::where('date', $yesterday)
            ->where('user_id', $user->id)
            ->exists();

        return view('pages.home', ['poll' => $poll, 'yesterday' => $jYesterday]);
    }

    public function login(Request $request)
    {
        return view('pages.login');
    }

    public function signIn(Request $request)
    {
//        dd($request->all());
        $remember = $request->get('remember', false);
        if (Auth::attempt($request->only(['username', 'password']), $remember)) {
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
