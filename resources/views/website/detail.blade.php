@extends('website.layouts')
@section('title', 'Detail Product')
@section('content')

<section class="detail mt-5">
    <div class="container">
        <div class="row">
          <div class="col-md-6">
            <a href="{{asset('storage/'. $product->image)}}" data-lightbox="models" data-title="Image Of Product {{$product->name}}">
                <img src="{{asset('storage/' . $product->image)}}" class="mx-auto rounded mb-3" style="width: 100%;height:auto;objectfit:cover;" alt="">
            </a>
            <div class="row mt-4">
                @forelse ($limitedImages as $image)
                <div class="col-4">
                    <a href="{{asset('storage/'. $image->image)}}" data-lightbox="models" data-title="Image Of Product {{$product->name}}">
                        <img src="{{asset('storage/' . $image->image)}}" class="img-thumbnail ronded mx-auto" style="max-height: 200px;object-fit-cover;width:100%;" alt="Gallery Product">
                    </a>
                </div>
                @empty

                @endforelse
            </div>
          </div>
          <div class="col-md-6">
            <h1 class="mb-4 mt-5 fw-bold">{{$product->name}}</h1>
            <p class="h5 mb-4">Rp {{number_format($product->price)}} IDR</p>
            <form action="{{route('addToCart')}}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="select-color mb-4">
                    <p class="h6 fw-bold">Select Color</p>
                    {{-- foreach  --}}
                    @foreach ($product->attributes->where('status', 80)->pluck('color_id')->unique() as $color)
                        <label for="color_{{$color}}" id="label-{{$color}}" class="btn-color btn btn-outline-dark rounded me-2">
                            <input style="display: none" type="radio" name="color" id="color_{{$color}}" data-id="{{$color}}" class="size-input" onclick="colorInput(this)" value="{{$color}}" >
                            <span class="p m-0">{{$getColor[$color]}}</span>
                        </label>                        
                    @endforeach
                    {{-- endforeach  --}}
                </div>
                <div class="select-size mb-4">
                    <p class="h6 fw-bold">Select Size</p>
                    {{-- foreach  --}}
                    @foreach ($product->attributes->where('status', 80)->sortBy('order')->pluck('size')->unique() as $size)
                    <label for="size_{{$size}}" id="label-{{$size}}" class="btn-size btn btn-light me-2">
                        <input style="display: none" type="radio" name="size" id="size_{{$size}}" data-id="{{$size}}" class="size-input" onclick="sizeInput(this)" value="{{$size}}" >
                        <span class="p m-0">{{$size}}</span>
                    </label>
                    @endforeach
                    {{-- endforeach  --}}
                </div>
                <button type="submit" class="submit-bag btn btn-outline-dark mb-3 w-100" disabled >Add To Bag</button>
            </form>
                <div class="mb-4">
                    <a href="javascript:void(0)" class="text-decoration-none text-white" id="whatsapp-link"><button class="submit-buy btn btn-dark w-100" disabled for="whatsapp-link">Buy It Now</button></a>
                </div>
            <div class="bg-light p-4 shadow-sm">
                {!! $product->description !!}
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
            @forelse ($newProduct as $newItem)
                    <div class="col-lg-3 col-6">
                        <a class="nav-link p-0 mb-4" href="{{route('detail', $newItem->slugs)}}">
                            <div class="item">
                                <div class="card">
                                    <img src="{{asset('storage/' . $newItem->image)}}" class="card-img-top" alt="{{$newItem->name}}">
                                    <div class="card-body">
                                      <h5 class="card-title text-dark mb-0 mb-sm-2">{{$newItem->name}}</h5>
                                      <div class="mb-sm-3 mb-2">
                                        @forelse ($newItem->attributes as $attr)
                                        <div class="btn btn-light mt-2 container-size">
                                            <p class="mb-0">{{$attr->size}}</p>
                                        </div>
                                        @empty
                                        <div class="btn btn-light mt-2 container-size">
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
    let colorList = JSON.parse('{!!json_encode($product->attributes->pluck('color_id')->unique())!!}')
    let sizeList = JSON.parse('{!!json_encode($product->attributes->pluck('size')->unique())!!}')
    let getColor = JSON.parse('{!!json_encode($getColor)!!}')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function checkAvailable(type, value){
        $.ajax({
            url : "{{route('checkAvailable')}}",
            type : 'POST',
            data:{
                productId : '{{$product->id}}',
                type : type,
                value : value
            },
            success: function(response){
                if(response.data.length > 0){
                    if (response.type == 'size') {
                        $(Object.values(colorList)).each(function(index, item){
                            if (!response.data.includes(item)) {
                                $('#color_'+item).attr('disabled', true)
                                $('#color_'+item).parent().addClass('disabled-color')
                            }else{
                                $('#color_'+item).attr('disabled', false)
                                $('#color_'+item).parent().removeClass('disabled-color')
                            }
                        })
                    }else if(response.type == 'color'){
                        $(Object.values(sizeList)).each(function(index, item){
                            if (!response.data.includes(item)) {
                                $('#size_'+item).attr('disabled', true)
                                $('#size_'+item).parent().addClass('disabled-size')
                            }else{
                                $('#size_'+item).attr('disabled', false)
                                $('#size_'+item).parent().removeClass('disabled-size')
                            }
                        })
                    }
                    checkInputProcess()
                };
            }
        });
    }
    
    function sizeInput(el){
        $('.btn-size').addClass('btn-light');
        $('.btn-size').removeClass('btn-secondary');
        $(el).parent().addClass('btn-secondary');
        $(el).parent().removeClass('btn-light');
        checkAvailable('size', $(el).val())
    }
    function colorInput(el){
        console.log(colorList);
        $('.btn-color').addClass('btn-outline-dark');
        $('.btn-color').removeClass('btn-dark');
        $(el).parent().addClass('btn-dark');
        $(el).parent().removeClass('btn-outline-dark');
        checkAvailable('color', $(el).val())
    }
    function checkInputProcess(){
        if($('input[name="size"]').is(':checked') && $('input[name="color"]').is(':checked')){
            $('.submit-bag').prop("disabled", false);
            $('.submit-buy').prop("disabled", false);
            updateWhatsAppLink()
        }
    }
    
    function updateWhatsAppLink() {
        let size = $('input[name="size"]').val();
        let color = getColor[$('input[name="color"]').val()];
        let productName = `{{$product->name}}`;
        let cleanName = productName.replace(/&#039;/g, '')
        let link = `https://wa.me/62{{$setting['whatsapp'] ?? ''}}?text=Hello,%20I%20want%20to%20ask%20about%20the%20availability%20of%20this%20product%20%3F%0A%0A---- The%20Product ----%20%0AName%20%3A%20`+cleanName+`%0APrice%20%3A%20{{number_format($product->price)}}%0ACategory%20%3A%20{{$product->category}}%0ASize%20%3A%20` + size + `%0AColor%20%3A%20` + color + `%0ALink%20%3A%20{{url()->current()}}%0A%0AIf%20this%20product%20is%20available,%20I%20am%20interested%20in%20continuing%20with%20the%20ordering%20process`;
        
        $('#whatsapp-link').attr('href', link);
        $('#whatsapp-link').attr('target', '_blank');
    }
</script>
@stop