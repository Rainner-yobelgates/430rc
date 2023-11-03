@extends('website.layouts')
@section('title', 'Detail Product')
@section('content')

<section class="detail mt-5">
    <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="{{asset('assets/website/image/detail.png')}}" class="mx-auto rounded mb-3" style="width: 100%;height:auto;objectfit:cover;" alt="">
            <div class="row mt-4">
                <div class="col-4">
                    <img src="{{asset('assets/website/image/g1.png')}}" class="img-thumbnail ronded mx-auto" style="max-height: 200px;object-fit-cover;width:100%;" alt="">
                </div>
                <div class="col-4">
                    <img src="{{asset('assets/website/image/g2.png')}}" class="img-thumbnail ronded mx-auto" style="max-height: 200px;object-fit-cover;width:100%;" alt="">
                </div>
                <div class="col-4">
                    <img src="{{asset('assets/website/image/g4.png')}}" class="img-thumbnail ronded mx-auto" style="max-height: 200px;object-fit-cover;width:100%;" alt="">
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <h1 class="mb-4 mt-5 fw-bold">Collection V1</h1>
            <h4 class="mb-4 fw-bold">Mens Running Singlet</h4>
            <p class="h6 mb-4">Rp 300.000 IDR</p>
            <div class="select-size mb-4">
                <p class="h6 fw-bold">Select Size</p>
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
            <div class="mb-4">
                <a class="btn btn-dark mb-3 w-100" href="">Add To Bag</a>
                <a class="btn btn-outline-dark w-100" href="">Buy It Now</a>
            </div>
            <div class="bg-light p-4">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, illum magni ipsa excepturi commodi deleniti. Et, ad temporibus odit unde beatae repellat ab, eligendi soluta officiis ut eius voluptas labore, nemo alias eos id iure. Doloremque voluptatem consequatur omnis distinctio. Dignissimos nesciunt culpa reprehenderit saepe, quam fuga quidem numquam incidunt.</p>
            </div>
          </div>
        </div>
    </div>
</section>
<section class="newest mt-5">
    <div class="container">
        <hr>
        <div class="row">
            <h1 class="fw-bold mb-4">Our Newest Product</h1>
            @for ($i = 1; $i <= 7; $i++)
                <div class="col-lg-3 col-md-6">
                    <a class="nav-link p-0 mb-4" href="">
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
    </div>
</section>
@stop