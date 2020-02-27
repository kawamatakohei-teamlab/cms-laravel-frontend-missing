<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@yield('head')
</head>
<body>
@yield('header')
<main class="c-main">
@yield('notice_main')
</main>
@yield('breadcrumb')
</body>
@yield('footer')
@yield('javascript')
</html>