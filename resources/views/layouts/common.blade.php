<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    {{-- site setting meta --}}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no, address=no, email=no">
    <meta name="robots" content="follow,index">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- site information --}}
    <title>
        @yield('title', config('consts.siteInfo.default.title'))
    </title>
    <meta name="description" content="@yield('description', config('consts.siteInfo.default.description'))">
    <meta name="keywords" content="">

    {{-- site icons --}}
    <link rel="icon" sizes="196x196" href="{{ imageUrl(config('consts.siteInfo.default.faviconImageName')) }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ imageUrl(config('consts.siteInfo.default.appleTouchIconImageName')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ imageUrl(config('consts.siteInfo.default.shortcutIconImageName')) }}">

    {{-- og meta --}}
    <meta property="og:title" content="@yield('title', config('consts.siteInfo.default.title'))">
    <meta property="og:description" content="@yield('description', config('consts.siteInfo.default.description'))">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ imageUrl(config('consts.siteInfo.default.ogpImageName')) }}">

    {{-- Windows settings --}}
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="msapplication-TileImage" content="{{ imageUrl(config('consts.siteInfo.default.msapplicationTileImageName')) }}">
    <meta name="msapplication-TileColor" content="#fff">

    {{-- smart phone browser theme setting --}}
    <meta name="theme-color" content="#fff">

    {{-- stylesheets --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Hind:400,500,600,700">
    <link rel="stylesheet" href="/styles/touch-device-style.css">

    @include('partials.layout.head_javascript')
  </head>
  <body class="base-page">
    @yield('header_javascript')
    @include('partials.layout.header')

    @yield('breadcrumb')

    <div class="layout-base">
      @yield('main')
    </div>

    @include('partials.layout.footer')
    @include('partials.layout.modal')
    @include('partials.layout.footer_javascript')
    </body>
</html>
