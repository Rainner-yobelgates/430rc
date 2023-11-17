@extends('website.layouts')
@section('title', 'Detail Product')
@section('content')

<section class="detail mt-5">
    <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="{{asset('storage/' . $product->image)}}" class="mx-auto rounded mb-3" style="width: 100%;height:auto;objectfit:cover;" alt="">
            <div class="row mt-4">
                @forelse ($product->images as $image)
                <div class="col-4">
                    <img src="{{asset('storage/' . $image->image)}}" class="img-thumbnail ronded mx-auto" style="max-height: 200px;object-fit-cover;width:100%;" alt="Gallery Product">
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
                <input type="hidden" name="name" value="{{$product->name}}">
                <input type="hidden" name="slugs" value="{{$product->slugs}}">
                <input type="hidden" name="price" value="{{$product->price}}">
                <input type="hidden" name="image" value="{{$product->image}}">
                <div class="select-color mb-4">
                    <p class="h6 fw-bold">Select Color</p>
                    {{-- foreach  --}}
                    @foreach ($product->attributes->pluck('color_id')->unique() as $color)
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
                    @foreach ($product->attributes->sortBy('order')->pluck('size')->unique() as $size)
                    <label for="size_{{$size}}" id="label-{{$size}}" class="btn-size btn btn-light me-2">
                        <input style="display: none" type="radio" name="size" id="size_{{$size}}" data-id="{{$size}}" class="size-input" onclick="sizeInput(this)" value="{{$size}}" >
                        <span class="p m-0">{{$size}}</span>
                    </label>
                    @endforeach
                    {{-- endforeach  --}}
                </div>
                <button type="submit" class="submit-bag btn btn-dark mb-3 w-100" disabled href="">Add To Bag</button>
            </form>
                <div class="mb-4">
                    <button class="submit-buy btn btn-outline-dark w-100" disabled href="">Buy It Now</button>
                </div>
            <div class="bg-light p-4">
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
                    <div class="col-lg-3 col-md-6">
                        <a class="nav-link p-0 mb-4" href="{{route('detail', $newItem->slugs)}}">
                            <div class="item">
                                <div class="card">
                                    <img src="{{asset('storage/' . $newItem->image)}}" class="card-img-top" alt="{{$newItem->name}}">
                                    <div class="card-body">
                                      <h5 class="card-title text-dark">{{$newItem->name}}</h5>
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
                <a href="" class="btn btn-dark w-25 mt-3 rounded-pill">View All</a>
            </div>
        </div>
    </div>
</section>
@stop
@section('script')
<script>
    let colorList = JSON.parse('{!!json_encode($product->attributes->pluck('color_id')->unique())!!}')
    let sizeList = JSON.parse('{!!json_encode($product->attributes->pluck('size')->unique())!!}')
    console.log(sizeList);
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
                };
            }
        });
    }
    
    function sizeInput(el){
        $('.btn-size').addClass('btn-light');
        $('.btn-size').removeClass('btn-secondary');
        $(el).parent().addClass('btn-secondary');
        $(el).parent().removeClass('btn-light');
        checkInputProcess()
        checkAvailable('size', $(el).val())
    }
    function colorInput(el){
        $('.btn-color').addClass('btn-outline-dark');
        $('.btn-color').removeClass('btn-dark');
        $(el).parent().addClass('btn-dark');
        $(el).parent().removeClass('btn-outline-dark');
        checkInputProcess()
        checkAvailable('color', $(el).val())
    }
    function checkInputProcess(){
        if($('input[name="size"]').is(':checked') && $('input[name="color"]').is(':checked')){
            $('.submit-bag').prop("disabled", false);
            $('.submit-buy').prop("disabled", false);
        }
    }
    
       
</script>
@stop