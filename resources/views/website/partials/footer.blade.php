<footer class="bg-dark mt-5">
    <div class="container">
        <div class="row py-4">
            <div class="col-6 col-md-4 col-lg-2" align="center">
                <img src="{{asset('assets/website/image/logo-white.png')}}" style="width: 115px" alt="image logo">
                <p class="text-white fw-bold">Follow Us</p>
                <div class="col-8 d-flex justify-content-around">
                    @if (isset($setting['instagram']))
                        <a class="text-white text-center h4" target="_blank" href="{{$setting['instagram']}}"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if (isset($setting['tiktok']))
                        <a class="text-white text-center h4" target="_blank" href="{{$setting['tiktok']}}"><i class="fa-brands fa-tiktok"></i></a>
                    @endif
                    @if (isset($setting['whatsapp']))
                        <a class="text-white text-center h4" target="_blank" href="https://wa.me/62{{$setting['whatsapp']}}"><i class="fa-brands fa-whatsapp"></i></a>
                    @endif
                    @if (isset($setting['strava']))
                        <a class="text-white text-center h4" target="_blank" href="{{$setting['strava']}}"><i class="fa-brands fa-strava"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-6 col-md-8 col-lg-10 text-end">
                <p class="mb-0 text-white"><i class="fa-solid fa-location-pin"></i> {{$setting['location']}}</p>
            </div>
            <p class="text-white fw-bold text-center mb-0">&copy; 2023, 4:30 Running Club. All Rights Reserved</p>
        </div>
    </div>
</footer>