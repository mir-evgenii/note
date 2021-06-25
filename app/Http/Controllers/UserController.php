<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
