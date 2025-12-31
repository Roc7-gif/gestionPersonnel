<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserAuthController extends Controller
{
    //
    function register(Request $request)
    {
        $user = $request->validate([
            'password' => ['required', 'regex:/[a-z]/' ,'regex:/[A-Z]/' , 'regex:/[0,9]/', 'min:8', 'confirmed'  ],
            'name' => ['required', 'max:200'],
            'prénom' => ['required', 'max:200'],
            'phone' => ['required', 'string' , 'max:20'],
        ]);

        User::create([
            "name" => $user['name'],
            "email" => $user['email'],
            "phone" => $user['phone'],
            "password" => Hash::make($user['password']),
        ]);

        return redirect('/login')->with('message', 'Compte créer avec succès');

    }

    function showregister() {
            return view('front.register');
    }function login() {
    }
}
