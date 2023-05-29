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
    <div class="nav">
      <ul>
        <li class="link">
          <a href="{{ route('index') }}">ホーム</a>
        </li>
        <li class="link">
          <a href="{{ route('list', ['yyyy_mm_dd'=>$yyyy_mm_dd]) }}">日付一覧</a>
        </li>
        <li class="link">
          <a href="{{ route('users') }}">ユーザー一覧</a>
        </li>
        <li class="link">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">ログアウト</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        </li>
      </ul>
    </div>
  </header>
  <main class="main">
    @yield('main')
  </main>
  <footer class="footer">
    <h4>Atte, inc.</h4>
    @yield('footer')
  </footer>
</body>
</html>