@extends('layouts.default')

@section('header')
@endsection
@section('main')
<div class="card">
    <div class="title">
        <p>ログイン</p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
{{ $text }}
    <form class="login_form" method="POST" action="auth">
        @csrf
        <input class="box input_box" type="email" name="email" placeholder="メールアドレス" />
        <input class="box input_box" type="password" name="password" placeholder="パスワード" />
        <button class="box auth_btn">ログイン</button>
    </form>
    <div class="box redirect_msg">
        <p>アカウントをお持ちでない方はこちらから</p>
        <a href="/registration">会員登録</a>
    </div>
</div>
@endsection
@section('footer')
@endsection