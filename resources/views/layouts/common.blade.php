<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('parts.head')
    @include('parts.head_javascript')
  </head>
  <body class="base-page">
    @yield('header_javascript')
    @include('parts.header')

    @yield('breadcrumb')

    <div class="layout-base">
      @yield('main')
    </div>

    @include('parts.footer')
    @include('parts.modal')
    @include('parts.footer_javascript')
    </body>
</html>
