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

    public function create(Request $request)
    {
        $request->merge([
            'username' => $request->get('personal_code'),
            'password' => $request->get('national_code'),
            'level' => 2
        ]);
        User::create($request->all());
        return response()->json([]);
    }

    public function view(Request $request)
    {
        $id = $request->route('id');
        $user = User::find($id);

        return response()->json($user);
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $request->merge([
            'username' => $request->get('personal_code'),
            'password' => $request->get('national_code'),
            'level' => 2
        ]);
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        return response()->json([]);
    }

    public function delete(Request $request)
    {
        $id = $request->route('id');
        User::destroy($id);
        return response()->json([]);
    }
}
