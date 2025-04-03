<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/scss/app.scss'])

    <title>{{ env('APP_NAME') }} | @yield('title')</title>
</head>
<body>
    <header class="main-header">
        @include('partials.header')
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        @include('partials.footer')
    </footer>

</body>
</html>
