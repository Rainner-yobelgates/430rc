<section class="hero">
    <div id="carouselHero" class="carousel carousel-dark slide">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
            <img src="{{isset($setting['header']) ? asset('storage/'.$setting['header']) : asset('assets/website/image/hero.png')}}" style="object-fit:cover;" class="img-hero d-block w-100" alt="...">
            <div class="carousel-caption carousel-text-hero">
                <h5 class="text-white text-hero mb-1">{{$setting['title-header']}}</h5>
                <h4 class="text-white fw-bold text-title">{{$setting['sub-title-header']}}</h4>
                <a href="{{route('products')}}" class="btn-shop btn btn-light rounded-pill px-2 p-md-2 px-md-5 my-lg-3">Shop <i class="fas fa-arrow-right"></i></a>
                <h5 class="text-white mt-2 text-hero">{{$setting['text-header']}}</h5>
            </div>
            </div>
        </div>
    </div>
</section>