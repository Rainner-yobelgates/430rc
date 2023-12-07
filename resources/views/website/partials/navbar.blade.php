<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #f7f6f3">
    <div class="container">
      <a href="{{route('home')}}">
        <img src="{{asset('assets/website/image/logo.png')}}" style="width: 51px" alt="image logo">
      </a>
      <div class="d-flex">
        <a class="text-dark me-4 d-block d-lg-none" aria-current="page" href="{{route('products')}}"><i style="font-size: 19px" class="fa-solid fa-search"></i></a>
        <a class="text-dark me-4 d-block d-lg-none" aria-current="page" href="{{route('about')}}"><i style="font-size: 18px" class="fa-solid fa-user"></i></a>
        <a class="text-dark position-relative me-4 d-block d-lg-none" aria-current="page" href="{{route('cart')}}"><i style="font-size: 20px" class="fa-solid fa-bag-shopping"></i>
          @if (count(notif_cart()) > 0)
          <span class="position-absolute top-20 start-90 translate-middle p-1 bg-danger border border-light rounded-circle">
            <span class="visually-hidden">New alerts</span>
          </span>
          @endif
        </a>

        <button class="navbar-toggler collapsed d-lg-none flex-column d-flex justify-content-around" type="button"
          data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="toggler-icon top-bar"></span>
          <span class="toggler-icon middle-bar"></span>
          <span class="toggler-icon bottom-bar"></span>
        </button>
      </div>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Programs
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-center" href="{{route('running')}}">Running</a></li>
              <li><a class="dropdown-item text-center" href="{{route('workout')}}">Workout</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-center position-relative" aria-current="page" href="{{route('cart')}}"><i class="fa-solid fa-bag-shopping"></i>
              @if (count(notif_cart()) > 0)
              <span class="position-absolute top-20 start-90 translate-middle p-1 bg-danger border border-light rounded-circle">
                <span class="visually-hidden">New alerts</span>
              </span>
              @endif
            </a>
          </li>
      </div>
    </div>
  </nav>