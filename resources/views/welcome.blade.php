<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/welStyle.css') }}">
  <link rel="stylesheet" href="css/menu.css">
  <title>Projeto Biblioteca Showcase</title>
  <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/4/4259.png">
</head>
<body>
  <div class="menu-wrap">
    <input type="checkbox" class="toggler">
    <div class="hamburger"><div></div></div>
    <div class="menu">
      <div>
        <div>
          <ul>
            @guest
              <!-- Mostrar botões se o usuário não estiver logado -->
              <li><a href="{{ route('login') }}">Login</a></li>
              <li><a href="{{ route('register') }}">Register</a></li>
            @endguest
            @auth
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('catalogo') }}">Catalogo</a></li>
            @endauth
          </ul>
        </div>
      </div>
    </div>
  </div>

<header class="showcase">
    <div class="container showcase-inner">
        <h1>Descubra Nossa Biblioteca</h1>
        <p>Explore nossa seleção de livros e encontre suas próximas leituras favoritas. Navegue pelo nosso catálogo e descubra uma variedade de gêneros e autores.</p>
    </div>

  </header>
</body>
</html>
