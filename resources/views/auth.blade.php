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
            <p>ログイン</p>
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{ $text }}
    @if(count($errors) > 0)
        <p>入力内容に問題があります2</p>
    @endif
        <form class="login_form" method="POST" action="auth">
            @csrf
            @error('email')
            <tr>
                <th>ERROR:</th>
                <td>{{ $message }}</td>
            </tr>
            @enderror
            <input class="box input_box" type="email" name="email" placeholder="メールアドレス" />

            @error('password')
            <tr>
                <th>ERROR:</th>
                <td>{{ $message }}</td>
            </tr>
            @enderror
            <input class="box input_box" type="password" name="password" placeholder="パスワード" />
            <button class="box auth_btn">ログイン</button>
        </form>
        <div class="box redirect_msg">
            <p>アカウントをお持ちでない方はこちらから</p>
            <a href="/registration">会員登録</a>
        </div>
    </div>
</main>
<footer class="footer">
    <h4>Atte, inc.</h4>
</footer>
</body>
</html>
