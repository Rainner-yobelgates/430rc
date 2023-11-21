<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --> --}}
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">

    {{-- Lightbox --}}
    <link rel="stylesheet" href="{{ asset('plugins/lightbox2/dist/css/lightbox.css') }}">
    
    {{-- Owlcarousel --}}
    <link rel="stylesheet" href="{{ asset('plugins/owlcarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/owlcarousel/dist/assets/owl.theme.default.min.css') }}">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
  {{-- Ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
  </head>
  <body>
    @include('website.partials.navbar')

    @yield('content')

    @include('website.partials.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('plugins/owlcarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('plugins/lightbox2/dist/js/lightbox.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session()->has('success'))
    <script>
			swal({
			title: "Success",
			text: '{{session()->get('success')}}',
			icon: "success",
			button: "Oke",
		});
		</script>
    @elseif(session()->has('error'))
    <script>
			swal({
			title: "Error!",
			text: '{{session()->get('error')}}',
			icon: "error",
			button: "Oke",
		});
		</script>
	  @endif
    @yield('script')

  </body>
</html>