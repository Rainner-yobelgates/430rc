@extends('website.layouts')
@section('title', 'Home')
@section('content')
@include('website.partials.hero')

<section class="product mt-5">
    <div class="container">
        <div class="row">
            <h2 class="fw-bold mb-3">Our Product</h2>
            <div class="owl-carousel owl-theme mt-2">
                @forelse ($getProduct as $key => $product)
                <div class="item">
                    <a class="nav-link p-0" href="{{route('detail', $product->slugs)}}">
                        <div class="item">
                            <div class="card">
                                <img src="{{asset('storage/' . $product->image)}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title text-dark mb-0 mb-sm-2">{{$product->name}}</h5>
                                  <div class="mb-sm-3 mb-2">
                                    @forelse ($product->attributes as $attr)
                                    <div class="btn btn-light mt-2 container-size">
                                        <p class="mb-0">{{$attr->size}}</p>
                                    </div>
                                    @empty
                                    <div class="btn btn-light mt-2 container-size">
                                        <p class="mb-0">No size available</p>
                                    </div>
                                    @endforelse
                                  </div>
                                  <p class="card-title text-dark">Rp {{number_format($product->price)}} IDR</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                    
                @endforelse
            </div>
            <a class="btn btn-dark w-25 mx-auto rounded-pill mt-3" href="{{route('products')}}">View All</a>
        </div>
    </div>
</section>
<section class="motivation mt-4 pt-3 pb-4 bg-light">
    <h2 class="text-center fw-bold py-2">Run Make It Better</h2>
    <div class="container mt-3">
        <div class="row">
            <div id="carouselMotivation" class="carousel carousel-dark slide">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{isset($setting['motivation']) ? asset('storage/'.$setting['motivation']) : asset('assets/website/image/motivation.png')}}" style="object-fit:cover;" class="img-motivation d-block w-100" alt="...">
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
@if (isset($getFaq))
<section class="faq mt-4">
    <div class="container">
        <div class="row">
            <h2 class="fw-bold mb-3 text-center">FAQ</h2>
            <div class="accordion" id="accordionExample">
                @foreach ($getFaq as $key => $faq)
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{$key}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                            {{$faq->title}}
                        </button>
                    </h2>
                    <div id="collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body bg-light">
                            {!! $faq->content !!}
                        </div>
                    </div>
                    </div>
                @endforeach
                {{-- <div class="accordion-item">
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
                </div> --}}
              </div>
        </div>
    </div>
</section>
@endif
@stop
@section('script')
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop:false,
            margin:10,
            responsiveClass:true,
            responsive:{
                100:{
                    items:2,
                },
                600:{
                    items:2,
                },
                800:{
                    items:3,
                },
                1000:{
                    items:4,
                },
            }
        })
    });
</script>
@stop