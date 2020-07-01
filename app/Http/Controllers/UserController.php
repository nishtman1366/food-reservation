<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'ASC')->paginate(15);
        return view('pages.users', compact('users'));
    }
}
