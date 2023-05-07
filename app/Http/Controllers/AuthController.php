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
        $text = ['text' => 'NEW'];
        return view('auth', $text);

    }

    public function checkUser(AuthRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email,
        'password' => $password])) {
            return redirect ('/');
        } else {
            $text = '入力情報が誤っています';
        }
        return view('auth', ['text' => $text]);
    }

    public function register()
    {
        return view('registration');
    }

    public function registration(RegistrationRequest $request)
        {
            dd($request);
            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    // {
    //     $name = $request->name;
    //     $email = $request->email;
    //     $password = $request->password;

    //     if (User::where('name', '=', $name)->count() != 0 ){
    //         $text = '既に名前が登録されています';
    //     } elseif (Auth::where('email', '=', $email)->count() != 0){
    //         $text = '既にメールアドレスが登録されています';
    //     } else
    //     {}

    //     if ($password != $request->password_confirmation){
    //         $text = 'パスワードが確認欄の内容と一致しません';
    //     } else {
    //         $text = 'OK';
    //     }

        
    //     return view('registration', ['text' => $text]);
    // }
}