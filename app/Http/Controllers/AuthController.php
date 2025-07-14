<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;



class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // $user = $request->user;
        return response()->json([
            'user' => $validated
        ]);
    }

    public function register(UserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        event(new Registered($user));

        return response()->json([
            'user' => $validated
        ]);

    }
}
