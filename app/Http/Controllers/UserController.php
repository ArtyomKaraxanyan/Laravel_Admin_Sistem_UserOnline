<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Rainwater\Active\Active;

class UserController extends Controller
{

    public function index()
    {
        $users = User::whereNull('approved_at')->get();
        $users_online = Active::users()->get();
        $numberOfUsers = Active::users()->count();
        return view('users', compact('users','users_online','numberOfUsers'));
    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update(['approved_at' => now()]);

        return redirect()->route('admin.users.index')->withMessage('User approved successfully');
    }



}
