<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Telegram;


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
        $user = User::where('users.id', Auth::id())
            ->select('users.id', 'name', 'email', 'telegram.chat_id')
            ->leftJoin('telegram', 'users.id', '=', 'telegram.user_id')
            ->first();

        return view('dashboard', ['user' => $user]);
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

    // Update telegram chat id | method: PUT | host:port/user/telegram
    public function updateTelegramChatId(Request $request) {
        $telegram = Telegram::where('user_id', Auth::id())->first();

        if ($telegram == null) {
            $telegram = new Telegram();
        }

        $telegram->chat_id = $request->input('chat_id');
        $telegram->save();

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
