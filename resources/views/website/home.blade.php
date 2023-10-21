@extends('website.layouts')
@section('title', 'Home')
@section('content')
<section class="hero">
    <div class="hero-container" style="background-image: url({{asset('assets/website/image/hero.png')}})">
        <div class="container">
            <div class="text-container">
                <h5 class="text-white">THE COLLECTON 430</h5>
                <h4 class="text-white fw-bold mb-3">THE NEW BRAND LOCAL WITH GREAT QUALITY FROM INDONESIAN</h4>
                <a href="" class="btn btn-light rounded-pill p-2 px-5">Shop <i class="fas fa-arrow-right"></i></a>
                <h5 class="text-white mt-3">THIS IS OUR COLLECTION, LET’S SUPPORT LOCAL BRAND TO GO INTERNASIONAL</h5>
            </div>
        </div>
    </div>
</section>
<section class="product mt-5">
    <div class="container">
        <div class="row">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <a class="nav-link p-0" href="">
                        <div class="item">
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a class="nav-link p-0" href="">
                        <div class="item">
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a class="nav-link p-0" href="">
                        <div class="item">
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a class="nav-link p-0" href="">
                        <div class="item">
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a class="nav-link p-0" href="">
                        <div class="item">
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a class="nav-link p-0" href="">
                        <div class="item">
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                  <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </a>
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
                400:{
                    items:2,
                },
                600:{
                    items:3,
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