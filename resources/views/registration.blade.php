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

@if(count($errors) > 0)
<p>入力内容に問題があります</p>
@endif
  <form class="register_form" method="POST" action="{{ route('registration') }}">
    @csrf
    @error('name')
    <tr>
      <th>ERROR:</th>
      <td>{{ $message }}</td>
    </tr>
    @enderror
    <input class="box input_box" type="text" name="name" placeholder="名前" :value="old('name')" autofocus />

    @error('email')
    <tr>
      <th>ERROR:</th>
      <td>{{ $message }}</td>
    </tr>
    @enderror
    <input class="box input_box" type="email" name="email" placeholder="メールアドレス" :value="old('email')" />

    @error('password')
    <tr>
      <th>ERROR:</th>
      <td>{{ $message }}</td>
    </tr>
    @enderror
    <input class="box input_box" type="password" name="password" placeholder="パスワード" autocomplete="new-password" />

    @error('password_confirmation')
    <tr>
      <th>ERROR:</th>
      <td>{{ $message }}</td>
    </tr>
    @enderror
    <input class="box input_box" type="password" name="password_confirmation" placeholder="確認用パスワード" />
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