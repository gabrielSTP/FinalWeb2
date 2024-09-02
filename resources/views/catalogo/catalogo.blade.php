<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Library Catalog')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
</head>
<body>
    @section('content')
    <div class="content">
        <ul class="library"></ul>
        <div class="overlay-page"></div>
        <div class="overlay-summary"></div>
    </div>
    @show
    <script>
        // Passa os dados dos livros para uma variável JavaScript
        var booksData = @json($books);
    </script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>