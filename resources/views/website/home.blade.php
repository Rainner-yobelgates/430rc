@extends('website.layouts')
@section('title', 'Home')
@section('content')
@include('website.partials.hero')

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
                                  <div class="mb-3">
                                        <div class="btn btn-light mt-2">
                                            <p class="mb-0">S</p>
                                        </div>
                                        <div class="btn btn-light mt-2">
                                            <p class="mb-0">M</p>
                                        </div>
                                        <div class="btn btn-light mt-2">
                                            <p class="mb-0">L</p>
                                        </div>
                                        <div class="btn btn-light mt-2">
                                            <p class="mb-0">XL</p>
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
<section class="motivation mt-4 pt-3 pb-4 bg-light">
    <h1 class="text-center fw-bold py-2">Run Make It Better</h1>
    <div class="container mt-3">
        <div class="row">
            <div id="carouselMotivation" class="carousel carousel-dark slide">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{asset('assets/website/image/motivation.png')}}" style="max-height: 472px;object-fit:cover;" class="d-block w-100" alt="...">
                    <div class="carousel-caption carousel-text-motivation">
                        <h1 class="text-white text-quote mb-5 fw-bold">‘’ PRESTIGE FIRST, PACE FOLLOWS ‘’</h1>
                        <h5 class="text-white text-quote-by mb-1 fw-bold">~ 430 Running Club ~</h5>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="faq mt-4">
    <div class="container">
        <div class="row">
            <h1 class="fw-bold mb-3 text-center">FAQ</h1>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What types of products are available in this store?
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body bg-light">
                      <p class="mb-0 ms-2">We have several types of products, including sportswear, accessories, and other complements such as water bottles and socks.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Is this product specifically intended for runners?"
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body bg-light">
                        <p class="mb-0 ms-2">We have several types of products, including sportswear, accessories, and other complements such as water bottles and socks.</p>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        What types of products are available in this store?
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body bg-light">
                        <p class="mb-0 ms-2">We have several types of products, including sportswear, accessories, and other complements such as water bottles and socks.</p>
                    </div>
                  </div>
                </div>
              </div>
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
            }
        })
    });
</script>
@stop