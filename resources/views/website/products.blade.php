@extends('website.layouts')
@section('title', 'Products')
@section('content')

<section class="gallery mt-5">
    <div class="container mt-4">
        <div class="row">
            <h1 class="text-center fw-bold">Our Products</h1>
            <div class="d-flex align-items-center mb-4">
                <input type="text" class="form-control me-3" placeholder="Search Product Here">
                <i class="fas fa-search" style="font-size: 30px"></i>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm mb-3">
                    <a style="text-decoration: none;" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-dark fw-bold mb-0">Filter</h4>
                                <i class="fas fa-filter text-dark"></i>
                            </div>
                        </div>
                    </a>
                    <div class="card-body collapse show" id="collapseExample">
                        <h5 class="mb-1 fw-bold">Sort</h5>
                        <p class="mb-1">
                            <a href="?sort=latest" class="text-dark text-decoration-none">
                            <i class="fas fa-angle-right"></i>
                                Latest</a>
                        </p>
                        <p class="mb-1">
                            <a href="?sort=az" class="text-dark text-decoration-none">
                            <i class="fas fa-angle-right"></i>
                                Alphabet A-Z</a>
                        </p>
                        <p class="mb-1">
                            <a href="?sort=za" class="text-dark text-decoration-none">
                            <i class="fas fa-angle-right"></i>
                                Alphabet Z-A</a>
                        </p>
                        <p class="mb-1">
                            <a href="?sort=low_price" class="text-dark text-decoration-none">
                            <i class="fas fa-angle-right"></i>
                                Lowest Price</a>
                        </p>
                        <p class="mb-1">
                            <a href="?sort=high_price" class="text-dark text-decoration-none">
                            <i class="fas fa-angle-right"></i>
                                Highest Price</a>
                        </p>
                        <hr>
                        <h5 class="mb-2 fw-bold">Size</h5>
                        <div class="btn btn-light mb-2">
                            <p class="mb-0">S</p>
                        </div>
                        <div class="btn btn-light mb-2">
                            <p class="mb-0">M</p>
                        </div>
                        <div class="btn btn-light mb-2">
                            <p class="mb-0">L</p>
                        </div>
                        <div class="btn btn-light mb-2">
                            <p class="mb-0">XL</p>
                        </div>
                        <div class="btn btn-light mb-2">
                            <p class="mb-0">100 ML</p>
                        </div>
                        <div class="btn btn-light mb-2">
                            <p class="mb-0">150 ML</p>
                        </div>
                        <div class="btn btn-light mb-2">
                            <p class="mb-0">All Size</p>
                        </div>
                        <hr>
                        <h5 class="mb-1 fw-bold">Price</h5>
                        <form id="filter" type="get">
                            <div class="form-group d-flex align-items-center">
                                <input type="number" placeholder="From" class="form-control" name="min">
                                <div class="mx-2">-</div>
                                <input type="number" placeholder="To" class="form-control" name="max">
                            </div>
                        </form>
                        <div class="d-flex align-items-center justify-content-center mt-3">
                            <a href="{{ route('products') }}" class="btn btn-outline-danger me-3">Reset</a>
                            <button form="filter" class="btn btn-dark">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="row">
                @for ($i = 1; $i <= 7; $i++)
                    <div class="col-lg-4 col-md-6">
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
        </div>
    </div>
</section>
@stop