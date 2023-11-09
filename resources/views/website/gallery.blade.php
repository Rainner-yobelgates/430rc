@extends('website.layouts')
@section('title', 'Gallery')
@section('content')

<section class="gallery mt-5">
    <div class="container mt-4">
        <div class="row">
            <h1 class="text-center fw-bold mb-3">Our Gallery</h1>
            @if (isset($getGallery))
            @foreach ($getGallery as $gallery)
                <div class="col-lg-4 col-sm-6 mb-3">
                    <img src="{{asset('storage/'. $gallery->image)}}" class="img-fluid" alt="image gallery">
                </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
@stop