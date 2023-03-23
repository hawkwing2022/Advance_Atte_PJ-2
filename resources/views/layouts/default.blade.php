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
    @yield('header')
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