<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'api_token' => 'x',
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

    public function getPersonalCode(Request $request)
    {
        $name = $request->get('name');
        $users = User::where('last_name', 'LIKE', '%' . $name . '%')->get();
        return response()->json($users);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $oldPassword = $request->get('oldPassword');
        $newPassword = $request->get('newPassword');
        if (Hash::check($oldPassword, $user->password)) {
            $user->update(['password' => $newPassword]);
        } else {
            return response()->json(['message' => 'کلمه عبور کنونی اشتباه است'], 422);
        }
        return response()->json();
    }
}
