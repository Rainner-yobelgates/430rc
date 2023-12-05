@extends('website.layouts')
@section('title', 'About')
@section('content')

@include('website.partials.hero')
<section class="about mt-5">
    <div class="container mt-4">
        <div class="row">
            <h1 class="fw-bold">430 Running Club</h1>
            <div class="text-about">
                {!! $setting['about-content'] ?? '' !!}
            </div>
            <div id="carouselAbout" class="carousel carousel-dark slide mt-4">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{isset($setting['about-image']) ? asset('storage/'.$setting['about-image']) : asset('assets/website/image/about.png')}}" style="max-height: 400px;object-fit:cover" class="d-block w-100" alt="...">
                    {{-- <div class="carousel-caption carousel-text-about">
                        <h1 class="text-white text-quote mb-5 fw-bold">WHAT IS 4:30?</h1>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="emailus mt-5">
    <h2 class="text-center fw-bold mb-3">BE A PART OF US</h2>
    <div class="container">
        <div class="row">
            <div class="card p-4" style="background-color: #f7f6f3;">
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