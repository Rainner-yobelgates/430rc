<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">

    <title>@yield('title')</title>
  </head>
  <body>
    @include('website.partials.navbar')

    <script src="{{ asset('plugins/bootstrap/css/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>