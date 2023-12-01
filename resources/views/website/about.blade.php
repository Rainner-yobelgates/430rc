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
                    <img src="{{isset($setting['about-image']) ? asset('storage/'.$setting['about-image']) : asset('assets/website/image/about.png')}}" style="max-height: 400px;object-fit:cover" class="d-block w-100" alt="...">
                    <div class="carousel-caption carousel-text-about">
                        <h1 class="text-white text-quote mb-5 fw-bold">WHAT IS 4:30?</h1>
                    </div>
                    </div>
                </div>
            </div>
            <div class="text-about mt-4">
                {!! $setting['about-content'] ?? '' !!}
            </div>
        </div>
    </div>
</section>
<section class="emailus mt-5">
    <h2 class="text-center fw-bold mb-3">"Be a Part of Us!"</h2>
    <div class="container">
        <div class="row">
            <div class="card p-4">
                <h6 class="text-center">Be a part of us by entering your email.</h6>
                <form action="{{route('sendEmail')}}" method="post">
                    @csrf
                    <div class="input-group">
                        <input id="input_email" type="email" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" placeholder="Email" aria-label="email" aria-describedby="addon-wrapping">
                        <button class="btn btn-dark">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop