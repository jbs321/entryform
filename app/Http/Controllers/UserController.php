<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('edituser', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        $user->save();

        if(Auth::user()->is_admin) {
            return view('admin');
        }

        return view('home');
    }

    public function delete(User $user)
    {
        $user->delete();

        return view('admin');
    }
}
