@extends('website.layouts')
@section('title', 'Products')
@section('content')

<section class="gallery mt-5">
    <div class="container mt-4">
        <div class="row">
            <h1 class="text-center fw-bold">Our Products</h1>
            <div class="d-flex align-items-center mb-4">
                <input type="text" onkeyup="searchProduct(this)" id="search_product" class="form-control me-3" placeholder="Search Product Here">
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
                            <a href="?filter=latest" class="text-dark text-decoration-none">
                            <i class="fas fa-angle-right"></i>
                                Latest</a>
                        </p>
                        <p class="mb-1">
                            <a href="?filter=az" class="text-dark text-decoration-none">
                            <i class="fas fa-angle-right"></i>
                                Alphabet A-Z</a>
                        </p>
                        <p class="mb-1">
                            <a href="?filter=za" class="text-dark text-decoration-none">
                            <i class="fas fa-angle-right"></i>
                                Alphabet Z-A</a>
                        </p>
                        <p class="mb-1">
                            <a href="?filter=low_price" class="text-dark text-decoration-none">
                            <i class="fas fa-angle-right"></i>
                                Lowest Price</a>
                        </p>
                        <p class="mb-1">
                            <a href="?filter=high_price" class="text-dark text-decoration-none">
                            <i class="fas fa-angle-right"></i>
                                Highest Price</a>
                        </p>
                        <hr>
                        <h5 class="mb-2 fw-bold">Size</h5>
                        @foreach (list_size_product() as $size)
                            <a href="?filter={{$size}}" class="btn btn-light mb-2">
                                <p class="mb-0">{{$size}}</p>
                            </a>
                        @endforeach
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
                <div class="row" id="section_product">
                    @forelse ($getProduct as $product)
                    <div class="col-lg-4 col-md-6 col-6">
                        <a class="nav-link p-0 mb-4" href="{{route('detail', $product->slugs)}}">
                            <div class="item">
                                <div class="card">
                                    <img src="{{asset('storage/' . $product->image)}}" class="card-img-top" alt="{{$product->name}}">
                                    <div class="card-body">
                                      <h5 class="card-title text-dark">{{$product->name}}</h5>
                                      <div class="mb-3">
                                        @forelse ($product->attributes as $attr)
                                        <div class="btn btn-light mt-2 container-size">
                                            <p class="mb-0">{{$attr->size}}</p>
                                        </div>
                                        @empty
                                        <div class="btn btn-light mt-2 container-size">
                                            <p class="mb-0">No size available</p>
                                        </div>
                                        @endforelse
                                      </div>
                                      <p class="card-title text-dark">Rp {{number_format($product->price)}} IDR</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                        
                    @endforelse
                </div>
                {{$getProduct->links()}}
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
        function searchProduct(el){
            let keyword = $(el).val();
            $.ajax({
                url: '{{ route("products") }}',
                type: 'GET',
                data: {search: keyword},
                success: function(response){
                    let products = response.data;
                    let output = '';
                    if(products.length > 0){
                        products.forEach(function(product){
                            let attr = ''
                            if (product.attributes.length > 0) {
                                product.attributes.forEach(function (attribute, index) {
                                    attr += '<div class="btn btn-light mt-2 me-1">'+
                                                '<p class="mb-0">'+attribute.size+'</p>'+
                                            '</div>';
                                })
                            }else{
                                attr = '<div class="btn btn-light mt-2">'+
                                            '<p class="mb-0">No size available</p>'+
                                        '</div>';
                            }
                            let asset = '{{asset("storage/:url")}}'
                                asset = asset.replace(':url', product.image)
                            let price = parseInt(product.price).toLocaleString('id-ID', {
                                currency: 'IDR'
                            });
                            console.log(price);
                            output += '<div class="col-lg-4 col-md-6">'+
                                        '<a class="nav-link p-0 mb-4" href="">'+
                                            '<div class="item">'+
                                                '<div class="card">'+
                                                    '<img src="'+asset+'" class="card-img-top" alt="'+product.name+'">'+
                                                    '<div class="card-body">'+
                                                    '<h5 class="card-title text-dark">'+product.name+'</h5>'+
                                                    '<div class="mb-3">'+
                                                        attr+
                                                    '</div>'+
                                                    '<p class="card-title text-dark">Rp '+price+' IDR</p>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</a>'+
                                    '</div>';
                        });
                    } else {
                        output += '<div class="fw-bold d-flex justify-content-center align-items-center">Product not found <i class="ms-2 fas fa-box-open"></i></div>';
                    }

                    $('#section_product').html(output);
                }
            });
        }
    </script>
@endsection