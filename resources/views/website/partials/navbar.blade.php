<nav class="navbar navbar-expand-lg bg-white fixed-top">
    <div class="container">
      <img src="{{asset('assets/website/image/logo.png')}}" style="width: 115px" alt="image logo">
      <button class="navbar-toggler collapsed d-lg-none flex-column d-flex justify-content-around" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="toggler-icon top-bar"></span>
        <span class="toggler-icon middle-bar"></span>
        <span class="toggler-icon bottom-bar"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
          <li class="nav-item">
            <a class="nav-link active text-center" aria-current="page" href="{{route('home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-center" aria-current="page" href="{{route('about')}}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-center" aria-current="page" href="{{route('gallery')}}">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-center" aria-current="page" href="{{route('products')}}">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-center" aria-current="page" href="{{route('cart')}}"><i class="fa-solid fa-bag-shopping"></i></a>
          </li>
      </div>
    </div>
  </nav>