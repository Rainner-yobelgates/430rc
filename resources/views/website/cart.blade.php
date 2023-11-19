@extends('website.layouts')
@section('title', 'My Bag')
@section('content')

<section class="cart mt-5">
    <div class="container">
        <div class="row">
           <div class="col-md-7 col-xl-8 mt-3">
                <div class="bg-light d-flex justify-content-between align-items-center rounded px-4 py-3 mb-4">
                    <h4 class="fw-bold mb-0">My Bag</h4>
                    <h5 class="fw-bold mb-0">{{$countProduct}} Items</h5>
                </div>
                @if (isset($getCart))
                    @forelse ($getCart as $key => $product)
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-3 col-5 text-center">
                                <img src="{{asset('storage/' . $product['image'])}}" alt="" style="object-fit:cover;" class="img-fluid">
                            </div>
                            <div class="col-xl-9 col-7">
                                <div class="d-lg-flex justify-content-between">
                                    <h5 class="fw-bold">{{$product['name']}}</h5>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 fw-bold me-3">Rp {{number_format($product['price'])}} IDR</p>
                                        <form action="{{route('deleteCart', $key)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="background: none;border:none;">
                                                <i class="fas fa-square-minus text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <p class="mb-0 fw-bold mt-1">{{ucfirst($getColor[$product['color']])}} </p>
                                <p class="mb-0 fw-bold mt-1">Size {{$product['size']}} </p>
                            </div>
                            <hr class="mt-3">
                        </div>
                    @empty
                    <div class="row d-flex align-items-center">
                        <div class="col-12">
                            <h6 class="fw-bold text-center">Your cart is empty, <a href="{{route('products')}}" style="text-decoration: none">check our product</a></h6>
                        </div>
                        <hr class="mt-3">
                    </div>
                    @endforelse
                @else
                    <div class="row d-flex align-items-center">
                        <div class="col-12">
                            <h6 class="fw-bold text-center">Your cart is empty, <a href="{{route('products')}}" style="text-decoration: none">check our product</a></h6>
                        </div>
                        <hr class="mt-3">
                    </div>
                @endif

           </div>
           <div class="col-md-5 col-xl-4 mt-3">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 10px">
                <div class="card-body">
                  <h5 class="card-title text-center fw-bold mb-3">Shipping Address</h5>
                  <div class="form-group mb-2">
                    <label for="province">Province</label>
                    <select name="province" id="province" class="form-control" onchange="getCity()">
                        @foreach ($getProvince as $key => $province)
                        <option value="{{ $key }}">{{ $province }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group mb-2">
                    <label for="city">City</label>
                    <select name="city" id="city" class="form-control" onchange="getCourier()">
                    </select>
                  </div>
                  <div class="form-group mb-2">
                    <label for="courier">Courier</label>
                    <select name="courier" id="courier" class="form-control" onchange="getCost(this)">
                    </select>
                  </div>
                  <div class="form-group mb-2">
                    <label for="">Your Address</label>
                    <textarea name="address" class="form-control" id="address" rows="5" placeholder="Input your full address"></textarea>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-2 mt-3">
                    <p class="mb-0 fw-bold">Total Weight : </p>
                    <p class="mb-0 fw-bold">{{$totalWeight}} g</p>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="mb-0 fw-bold">Shipping Cost : </p>
                    <p class="mb-0 fw-bold cost-courier">0</p>
                  </div>
                  <span class="fst-italic text-info" style="font-size: 12px"><i class="fas fa-info-circle"></i> The cost is only an estimate, for more information, please proceed with your order.</span>
                </div>
            </div>
            <div class="card shadow-sm border-0" style="border-radius: 10px">
                <div class="card-body">
                  <h5 class="card-title text-center fw-bold mb-3">Summary</h5>
                  @if (isset($getCart))
                    @forelse ($getCart as $product)
                    <div class="row mb-2 d-flex align-items-center">
                        <div class="col-7">
                            <p class="mb-0">{{$product['name']}} ({{$product['size']}})</p>
                        </div>
                        <div class="col-5">
                            <p class="mb-0 text-end">{{number_format($product['price'])}}</p>
                        </div>
                    </div>
                    @empty
                    <div class="row mb-2 d-flex align-items-center">
                        <div class="col-12">
                            <p class="mb-0 text-center text-danger">Cart is empty</p>
                        </div>
                    </div>
                    @endforelse
                  @else
                  <div class="row mb-2 d-flex align-items-center">
                        <div class="col-12">
                            <p class="mb-0 text-center text-danger">Cart is empty</p>
                        </div>
                    </div>
                  @endif
                  <hr>
                  <div class="row mb-2 d-flex align-items-center">
                    <div class="col-6">
                        <p class="mb-0 fw-bold">Total : </p>
                    </div>
                    <div class="col-6">
                        <p class="mb-0 text-end fw-bold">{{number_format($totalPrice)}}</p>
                    </div>
                  </div>
                  <div class="row mb-2 d-flex align-items-center">
                    <div class="col-7">
                        <p class="mb-0 fw-bold">Shipping Cost : </p>
                    </div>
                    <div class="col-5">
                        <p class="mb-0 text-end fw-bold cost-courier">0</p>
                    </div>
                </div>
                <hr>
                <p class="mb-0 text-end fw-bold" id="totalPrice">0</p>
                </div>
              </div>
              <div class="d-flex justify-content-center mt-3">
                  <button class="btn btn-dark w-100" id="proccessBtn" disabled><a href="/test" class="text-decoration-none text-white">Process Order</a></button>
              </div>
           </div>
        </div>
    </div>
</section>
<section class="newest mt-5">
    <div class="container">
        <div class="row">
            <h1 class="fw-bold mb-4">Our Newest Product</h1>
            @forelse ($newProduct as $newItem)
                <div class="col-lg-3 col-md-6">
                    <a class="nav-link p-0 mb-4" href="{{route('detail', $newItem->slugs)}}">
                        <div class="item">
                            <div class="card">
                                <img src="{{asset('storage/' . $newItem->image)}}" class="card-img-top" alt="{{$newItem->name}}">
                                <div class="card-body">
                                    <h6 class="card-title text-dark">{{$newItem->name}}</h6>
                                    <div class="mb-3">
                                        @forelse ($newItem->attributes as $attr)
                                        <div class="btn btn-light mt-2">
                                            <p class="mb-0">{{$attr->size}}</p>
                                        </div>
                                        @empty
                                        <div class="btn btn-light mt-2">
                                            <p class="mb-0">No size available</p>
                                        </div>
                                        @endforelse
                                    </div>
                                    <p class="card-title text-dark">Rp {{number_format($newItem->price)}} IDR</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                
            @endforelse
            <div class="col-12 text-center">
                <a href="{{route('products')}}" class="btn btn-dark w-25 mt-3 rounded-pill">View All</a>
            </div>
        </div>
    </div>
</section>
@stop
@section('script')
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            getCity()
		});
        function getCity(){
            let province_id = $('#province').val()

            $.ajax({
                url: '{{route('getCities')}}',
                method: 'POST',
                data: {
                    province_id: province_id
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#city').html('<option value="">Loading...</option>')
                },
                success: function(res) {
                    $('#city').html(res.result);
                    $('#city').removeAttr('disabled');
                },
            })
            getCourier()
        }
        
        function getCourier(){
            let city_id = $('#city').val()
            let weight = '{{$totalWeight}}'

            $.ajax({
                url: '{{route('getCourier')}}',
                method: 'POST',
                data: {
                    city_id: city_id,
                    weight: weight,
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#courier').html('<option value="">Loading...</option>')
                },
                success: function(res) {
                    $('#courier').html(res.list);
                    $('#courier').removeAttr('disabled');
                },
            })
        }

        function getCost(el) {
            let total = '{{$totalPrice}}'
            let priceInt = parseInt($(el).val())
            let price = parseInt($(el).val()).toLocaleString('id-ID', {
                currency: 'IDR',
            });
            price = price.replace(/\./g, ',');

            $('.cost-courier').html(price)
            let totalPrice = parseInt(priceInt + parseInt(total)).toLocaleString('id-ID', {
                currency: 'IDR',
            });
            totalPrice = totalPrice.replace(/\./g, ',');
            $('#totalPrice').html(totalPrice)
            $('#proccessBtn').attr('disabled', false)
        }
    </script>
@endsection