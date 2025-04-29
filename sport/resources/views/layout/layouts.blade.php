<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script defer src="../../../public/js/main.js"></script>
    <link rel="stylesheet" href="{{asset('public/style/style.css')}}">

    <title>Sport | @yield('title', 'Главная')</title>
  
</head>

<body>
    <div class="wrapper">
        <aside class="sidebar left-sidebar"></aside>
        <div class="container">
            <div class="header">
              <nav class="navigation">
                  <ul>
                  <li id="app">
                      <a class="nav" href="/">ГЛАВНАЯ</a>
                      <a class="nav" href="/players">ИГРОКИ</a>
                      <a class="nav" href="/game">МАТЧИ</a>
                      <a class="nav" href="/shop">МАГАЗИН</a>
                  </li>
              </ul>
            </nav>
          <div class="user-menu">
            <img src="{{asset('public/image/chel.png')}}" alt="User Icon" class="user-icon">
            <div class="dropdown-menu">
                @if(Auth::guest())
                    <a href="/login">Вход</a>
                    <a href="/create">Регистрация</a>
                @else
                    <a href="{{ route('profile.edit') }}">Личный кабинет</a>
                    <a href="{{ route('cart') }}">Корзина</a>
                    <a href="{{ route('logout') }}">Выход</a>
                    @if(Auth::user()->role == 'Admin')
                        <a href="/types/create">Добавить категорию</a>
                        <a href="{{ route('product.create') }}">Добавить товар</a>
                        <a href="{{ route('admin.orders') }}">Заказы</a>
                    @endif
                @endif
            </div>
          </div>
        </div>

        <div class="content">
            @yield('content')
        </div>
        <div class="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../../../public/image/1.jpg" alt="Slide 1">
            </div>
            <div class="carousel-item">
              <img src="../../../public/image/2.jpg" alt="Slide 2">
            </div>
            <div class="carousel-item">
              <img src="../../../public/image/3.jpg" alt="Slide 3">
            </div>
          </div>

          <button class="carousel-control prev">&#10094;</button>
          <button class="carousel-control next">&#10095;</button>

          <div class="carousel-indicators">
            <span class="indicator active"></span>
            <span class="indicator"></span>
            <span class="indicator"></span>
          </div>
        </div>
      </div>
      <aside class="sidebar left-sidebar"></aside>
      <footer>
        <div class="content_row">
          <div class="footer">
              <a href="/info">О нас</a>
          </div>
          <br>
          <div>
            <p>2024 &copy;, Магнитогорск</p>
          </div>
        </div>
      </footer>
    </div>
</body>
</html>