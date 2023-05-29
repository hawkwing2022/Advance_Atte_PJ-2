<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/reset.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>Document</title>
  </head>
  <body>
    <header class="header">
      <h1>Atte</h1>
    </header>
    <main class="main">
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
    </main>
    <footer class="footer">
      <h4>Atte, inc.</h4>
    </footer>
  </body>
</html>