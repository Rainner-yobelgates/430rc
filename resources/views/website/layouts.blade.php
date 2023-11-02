<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --> --}}
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    
    {{-- Owlcarousel --}}
    <link rel="stylesheet" href="{{ asset('plugins/owlcarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/owlcarousel/dist/assets/owl.theme.default.min.css') }}">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">

    <title>@yield('title')</title>
  </head>
  <body>
    @include('website.partials.navbar')

    @yield('content')

    @include('website.partials.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('plugins/owlcarousel/dist/owl.carousel.min.js') }}"></script>

    @yield('script')
  </body>
</html>