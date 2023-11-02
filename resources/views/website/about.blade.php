@extends('website.layouts')
@section('title', 'About')
@section('content')

@include('website.partials.hero')
<section class="about mt-5">
    <h1 class="text-center fw-bold">About Us</h1>
    <div class="container mt-4">
        <div class="row">
            <div id="carouselAbout" class="carousel carousel-dark slide">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{asset('assets/website/image/about.png')}}" style="max-height: 500px;object-fit:cover" class="d-block w-100" alt="...">
                    <div class="carousel-caption carousel-text-about">
                        <h1 class="text-white text-quote mb-5 fw-bold">WHAT IS 4:30?</h1>
                    </div>
                    </div>
                </div>
            </div>
            <div class="text-about mt-4">
                <p class="h5 text-center">Initially we were just a community of sports lovers, especially running friends, but we are sure and optimistic that running is not just about sweating or toning the body, but through running we can also meet many people and establish good relationships with them.</p> 
                <br>
                <p class="h5 text-center">As time went by, we agreed to make community clothes, that's how our first shirt, 4:30 V1, was born, and over time not only we wanted the shirt, but also many friends or other people who wanted our clothes, so we agreed to make more clothes, and until now we continue to develop new hit products, not only running clothes, but also other accessories.</p>
                <br>
                <p class="h5 text-center">And the most interesting thing is that the origin of the name 04:30 comes from our habit or training hours at 04.30 in the morning or 04.30 in the afternoon depending on the program or training menu that we do, and over time, we agreed to name our community. 4:30 Running Club</p>
                
                </p>
            </div>
        </div>
    </div>
</section>
@stop