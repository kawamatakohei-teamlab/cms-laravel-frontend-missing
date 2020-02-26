<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@yield('head')
</head>
<body d="{{ $body_id }}"{{$body_class}}>
@yield('header')
<main class="c-main">
@yield('main_top')
@yield('search_store')
@yield('dynamic_item')
@yield('notice_list')
@yield('event_list')
</main>
</body>
@yield('footer')
@yield('javascript')
</html>
