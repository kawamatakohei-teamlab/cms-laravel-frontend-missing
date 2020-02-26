<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@yield('head')
</head>
<body>
<header>
@yield('header')
@yield('main_top')
@yield('search_store')
@yield('dynamic_item')
@yield('notice_list')
@yield('event_list')
</header>
</body>
@yield('footer')
@yield('javascript')
</html>
