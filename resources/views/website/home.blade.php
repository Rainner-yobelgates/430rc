@extends('website.layouts')
@section('title', 'Home')
@section('content')
<section class="hero">
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="{{asset('assets/website/image/hero.png')}}" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <h5 class="text-white text-hero mb-1">THE COLLECTON 430</h5>
                <h4 class="text-white fw-bold text-title">THE NEW BRAND LOCAL WITH GREAT QUALITY FROM INDONESIAN</h4>
                <a href="" class="btn btn-light rounded-pill p-sm-1 px-sm-3 p-md-2 px-md-5">Shop <i class="fas fa-arrow-right"></i></a>
                <h5 class="text-white mt-2 text-hero">THIS IS OUR COLLECTION, LET’S SUPPORT LOCAL BRAND TO GO INTERNASIONAL</h5>
            </div>
          </div>
        </div>
      </div>
</section>
<section class="product mt-5">
    <div class="container">
        <div class="row">
            <h1 class="fw-bold mb-3">Our Product</h1>
            <div class="owl-carousel owl-theme mt-2">
                @for ($i = 1; $i <= 7; $i++)
                <div class="item">
                    <a class="nav-link p-0" href="">
                        <div class="item">
                            <div class="card">
                                <img src="{{asset('assets/website/image/product.png')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h6 class="card-title text-dark">Prototype 001 - Men's Tank</h6>
                                  <div class="row my-3">
                                    <div class="col-4">
                                        <div class="btn btn-light">S</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="btn btn-light">M</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="btn btn-light">L</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="btn btn-light">XL</div>
                                    </div>
                                  </div>
                                  <p class="card-title text-dark">Rp 300.000 IDR</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endfor
            </div>
            <a class="btn btn-dark w-25 mx-auto rounded-pill mt-3" href="">View All</a>
        </div>
    </div>
</section>
@stop
@section('script')
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            responsive:{
                100:{
                    items:1,
                },
                600:{
                    items:2,
                },
                800:{
                    items:4,
                },
                1000:{
                    items:5,
                },
                1200:{
                    items:6,
                }
            }
        })
    });
</script>
@stop