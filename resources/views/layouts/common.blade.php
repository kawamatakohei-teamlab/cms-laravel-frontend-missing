<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no, address=no, email=no">
    <meta name="robots" content="follow,index">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>title</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta property="og:title" content="大阪芸術大学">
    <meta property="og:description" content="">
    <meta property="og:url" content="siteURL/">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="website">
    <meta property="og:image" content="http://www.osaka-geidai.ac.jp/assets/images/ogp.jpg">
    <link rel="icon" sizes="196x196" href="/assets/images/favicon-196x196.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/images/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="msapplication-TileImage" content="/assets/images/mstile-144x144.png">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="theme-color" content="#fff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Hind:400,500,600,700">
    <link rel="stylesheet" href="/styles/touch-device-style.css">

    @include('partials.layout.head')
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
