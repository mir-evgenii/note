<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    const ADMIN_ID = 0; // User with id = 0 admin

    // Get all users | method: GET | host:port/user
    public function getAllUsers() {
        self::isAdmin404();

        $users = User::get();

        return view('users', ['users' => $users]);
    }

    // Get user | method: GET | host:port/dashboard
    public function getUser() {
        $id = Auth::id();

        return view('dashboard', ['user' => User::find($id)]);
    }

    // Update user | method: PUT | host:port/user
    public function updateUser(Request $request) {
        $id = Auth::id();
        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('dashboard');
    }

    // Update user password | method: PUT | host:port/password
    public function updatePassword(Request $request) {
        $id = Auth::id();
        $user = User::find($id);
        $hashed_old_pass = Hash::make($request->input('old_password'));

        if ($user->password === $hashed_old_pass && $request->input('new_password_1') === $request->input('new_password_2')) {
            $user->password = Hash::make($request->input('new_password_1'));
            $user->save();
        }

        return redirect()->route('dashboard');
    }

    // Delete user | method: DELETE | host:port/user/{id}
    public function delUser(Request $request) {
        self::isAdmin404();

        if ($request->id != self::ADMIN_ID) {
            $user = User::find($request->id);
            if ($user != null) {
                $user->delete();
            }
        }

        return redirect()->route('user');
    }

    private static function isAdmin404() {
        if (Auth::id() == self::ADMIN_ID) {
            return true;
        } else {
            abort(404);
        }
    }

    public static function isAdmin() {
        if (Auth::id() == self::ADMIN_ID) {
            return true;
        } else {
            return false;
        }
    }
}
