@extends('website.layouts')
@section('title', 'Gallery')
@section('content')

<section class="gallery mt-5">
    <h1 class="text-center fw-bold">Our Gallery</h1>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-4 col-sm-6 mb-3">
                <img src="{{asset('assets/website/image/g1.png')}}" class="img-fluid" alt="image gallery">
            </div>
            <div class="col-lg-4 col-sm-6 mb-3">
                <img src="{{asset('assets/website/image/g2.png')}}" class="img-fluid" alt="image gallery">
            </div>
            <div class="col-lg-4 col-sm-6 mb-3">
                <img src="{{asset('assets/website/image/g3.png')}}" class="img-fluid" alt="image gallery">
            </div>
            <div class="col-lg-4 col-sm-6 mb-3">
                <img src="{{asset('assets/website/image/g4.png')}}" class="img-fluid" alt="image gallery">
            </div>
            <div class="col-lg-4 col-sm-6 mb-3">
                <img src="{{asset('assets/website/image/g5.png')}}" class="img-fluid" alt="image gallery">
            </div>
            <div class="col-lg-4 col-sm-6 mb-3">
                <img src="{{asset('assets/website/image/g6.png')}}" class="img-fluid" alt="image gallery">
            </div>
            <div class="col-lg-4 col-sm-6 mb-3">
                <img src="{{asset('assets/website/image/g7.png')}}" class="img-fluid" alt="image gallery">
            </div>
            <div class="col-lg-4 col-sm-6 mb-3">
                <img src="{{asset('assets/website/image/g8.png')}}" class="img-fluid" alt="image gallery">
            </div>
        </div>
    </div>
</section>
@stop