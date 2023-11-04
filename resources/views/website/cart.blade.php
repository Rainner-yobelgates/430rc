@extends('website.layouts')
@section('title', 'My Bag')
@section('content')

<section class="cart mt-5">
    <div class="container">
        <div class="row">
           <div class="col-md-7 col-xl-8 mt-3">
                <div class="bg-light d-flex justify-content-between align-items-center rounded px-4 py-3 mb-4">
                    <h4 class="fw-bold mb-0">My Bag</h4>
                    <h5 class="fw-bold mb-0">1 Items</h5>
                </div>
                <div class="row d-flex align-items-center">
                    <div class="col-xl-3 col-5 text-center">
                        <img src="{{asset('assets/website/image/product.png')}}" alt="" style="object-fit:cover;" class="img-fluid">
                    </div>
                    <div class="col-xl-9 col-7">
                        <h5 class="fw-bold">Collection V1</h5>
                        <div class="d-lg-flex justify-content-between">
                            <p class="mb-0">MEN’S RUNNING SINGLET </p>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 fw-bold me-3">Rp 300.000 IDR</p>
                                <i class="fas fa-square-minus text-danger"></i>
                            </div>
                        </div>
                        <p class="mb-0 fw-bold mt-3">Size L </p>
                    </div>
                    <hr class="mt-3">
                </div>
                <div class="row d-flex align-items-center">
                    <div class="col-xl-3 col-5 text-center">
                        <img src="{{asset('assets/website/image/product.png')}}" alt="" style="object-fit:cover;" class="img-fluid">
                    </div>
                    <div class="col-xl-9 col-7">
                        <h5 class="fw-bold">Collection V1</h5>
                        <div class="d-lg-flex justify-content-between">
                            <p class="mb-0">MEN’S RUNNING SINGLET </p>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 fw-bold me-3">Rp 300.000 IDR</p>
                                <i class="fas fa-square-minus text-danger"></i>
                            </div>
                        </div>
                        <p class="mb-0 fw-bold mt-3">Size L </p>
                    </div>
                    <hr class="mt-3">
                </div>
                <div class="row d-flex align-items-center">
                    <div class="col-xl-3 col-5 text-center">
                        <img src="{{asset('assets/website/image/product.png')}}" alt="" style="object-fit:cover;" class="img-fluid">
                    </div>
                    <div class="col-xl-9 col-7">
                        <h5 class="fw-bold">Collection V1</h5>
                        <div class="d-lg-flex justify-content-between">
                            <p class="mb-0">MEN’S RUNNING SINGLET </p>
                            <div class="d-flex align-items-center">
                                <p class="mb-0 fw-bold me-3">Rp 300.000 IDR</p>
                                <i class="fas fa-square-minus text-danger"></i>
                            </div>
                        </div>
                        <p class="mb-0 fw-bold mt-3">Size L </p>
                    </div>
                    <hr class="mt-3">
                </div>
           </div>
           <div class="col-md-5 col-xl-4 mt-3">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 10px">
                <div class="card-body">
                  <h5 class="card-title text-center fw-bold mb-3">Shipping Address</h5>
                  <div class="form-group mb-2">
                    <label for="">Province</label>
                    <input type="text" class="form-control" name="province" placeholder="">
                  </div>
                  <div class="form-group mb-2">
                    <label for="">City</label>
                    <input type="text" class="form-control" name="province" placeholder="">
                  </div>
                  <div class="form-group mb-2">
                    <label for="">District</label>
                    <input type="text" class="form-control" name="province" placeholder="">
                  </div>
                  <div class="form-group mb-2">
                    <label for="">Sub District</label>
                    <input type="text" class="form-control" name="province" placeholder="">
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-2 mt-3">
                    <p class="mb-0 fw-bold">Total Weight : </p>
                    <p class="mb-0 fw-bold">500 g</p>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="mb-0 fw-bold">Shipping Cost : </p>
                    <p class="mb-0 fw-bold">500.000</p>
                  </div>
                  <span class="fst-italic text-info" style="font-size: 12px"><i class="fas fa-info-circle"></i> The cost is only an estimate, for more information, please proceed with your order.</span>
                </div>
            </div>
            <div class="card shadow-sm border-0" style="border-radius: 10px">
                <div class="card-body">
                  <h5 class="card-title text-center fw-bold mb-3">Summary (3)</h5>
                  <div class="row mb-2 d-flex align-items-center">
                    <div class="col-7">
                        <p class="mb-0">Prototype 001 - Men's Tank  XL</p>
                    </div>
                    <div class="col-5">
                        <p class="mb-0 text-end">6.099.999</p>
                    </div>
                  </div>
                  <div class="row mb-2 d-flex align-items-center">
                    <div class="col-7">
                        <p class="mb-0">Prototype 001  XL</p>
                    </div>
                    <div class="col-5">
                        <p class="mb-0 text-end">1.099.999</p>
                    </div>
                  </div>
                  <div class="row mb-2 d-flex align-items-center">
                    <div class="col-7">
                        <p class="mb-0">Men's Tank  XL</p>
                    </div>
                    <div class="col-5">
                        <p class="mb-0 text-end">5.099.999</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row mb-2 d-flex align-items-center">
                    <div class="col-6">
                        <p class="mb-0 fw-bold">Total : </p>
                    </div>
                    <div class="col-6">
                        <p class="mb-0 text-end fw-bold">15.099.999</p>
                    </div>
                  </div>
                  <div class="row mb-2 d-flex align-items-center">
                    <div class="col-7">
                        <p class="mb-0 fw-bold">Shipping Cost : </p>
                    </div>
                    <div class="col-5">
                        <p class="mb-0 text-end fw-bold">500.000</p>
                    </div>
                </div>
                <hr>
                <p class="mb-0 text-end fw-bold">15.599.000</p>
                </div>
              </div>
           </div>
        </div>
    </div>
</section>
<section class="newest mt-5">
    <div class="container">
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
            <div class="col-12 text-center">
                <a href="" class="btn btn-dark w-25 mt-3 rounded-pill">View All</a>
            </div>
        </div>
    </div>
</section>
@stop