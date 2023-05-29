<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $text = '';
        return view('auth', ['text' => $text]);
    }

    public function checkUser(AuthRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email,
        'password' => $password])) {
            return redirect ('/');
        } else {
            $text = '入力情報が誤っています1';
        }
        return view('auth', ['text' => $text]);
    }

    public function register()
    {
        return view('registration');
    }

    public function registration(RegistrationRequest $request)
        {
            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
