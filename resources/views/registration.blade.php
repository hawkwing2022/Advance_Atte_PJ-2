@extends('layouts.default')

@section('header')
@endsection
@section('main')
<div class="card">
  <div class="title">
    <p>会員登録</p>
  </div>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <!-- Validation Errors -->
  <x-auth-validation-errors class="mb-4" :errors="$errors" />
new
  <form class="register_form" method="POST" action="{{ route('registration') }}">
    @csrf
    <input class="box input_box" type="text" name="name" placeholder="名前" :value="old('name')" required autofocus />
    <input class="box input_box" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required />
    <input class="box input_box" type="password" name="password" placeholder="パスワード" required autocomplete="new-password" />
    <input class="box input_box" type="password" name="password_confirmation" placeholder="確認用パスワード" required/>
    <button class="box auth_btn">会員登録</button>
  </form>
  <div class="box redirect_msg">
    <p class="redirect_msg">アカウントをお持ちの方はこちらから</p>
    <a href="/auth">ログイン</a>
  </div>
</div>
@endsection
@section('footer')
@endsection