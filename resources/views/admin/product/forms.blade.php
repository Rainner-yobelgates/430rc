<?php 
    $attr = '';
    if($viewType == 'show'){
        $attr = 'disabled';
    }
?>
@extends('admin.layouts')
@section('title', $title)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            @if($viewType == 'create')
                <form action="{{route('panel.product.store')}}" method="post" enctype="multipart/form-data">
            @elseif($viewType == 'edit')
                <form action="{{route('panel.product.update', $product->id)}}" method="post" enctype="multipart/form-data">
                @method('patch')
            @endif
            @csrf
            <div class="card-header">
                <h5>{{$title}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"  class="form-control"
                        placeholder="Input Name Field" {{$attr}}>
                        @error('name')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Price <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}"  class="form-control"
                        placeholder="Input Price Field" {{$attr}}>
                        @error('price')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Image <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        @isset($product->image)
                        <div class="mb-2 border" style="width: 200px">
                            <img src="{{asset('storage/'. $product->image)}}" class="img-fluid" style="object-fit: contain;" alt="user photo">
                        </div> 
                        @endisset
                        <input type="file" name="image" class="form-control" {{$attr}}>
                        @error('image')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="category" class="form-control" {{$attr}}>
                            @foreach (list_category_product() as $key => $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Weight <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="weight" value="{{ old('weight', $product->weight ?? '') }}"  class="form-control"
                        placeholder="Input Weight Field" {{$attr}}>
                        @error('weight')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="floatingTextarea2" name="description" style="height: 100px">{!!$product->description ?? ''!!}</textarea>
                        @error('description')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Order <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="order" value="{{ old('order', $product->order ?? '') }}"  class="form-control"
                        placeholder="Input Order Field" {{$attr}}>
                        @error('order')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control" {{$attr}}>
                            @foreach (get_list_status() as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                @if($viewType == 'create')
                    <button type="submit" class="mb-2 mr-2 btn btn-success" title="Save">
                        <i class="fas fa-save"></i><span> Save</span>
                    </button>
                @elseif ($viewType == 'edit')
                    <button type="submit" class="mb-2 mr-2 btn btn-primary" title="Update">
                        <i class="fas fa-save"></i><span> Update</span>
                    </button>
                @elseif ($viewType == 'show')
                    <a href="{{route('panel.product.edit', $product->id)}}" class="mb-2 mr-2 btn btn-primary"
                        title="Back">
                        <i class="fas fa-edit"></i><span> Edit</span>
                    </a>
                @endif
                <a href="{{route('panel.product.index')}}" class="mb-2 mr-2 btn btn-warning"
                   title="Back">
                    <i class="fas fa-arrow-left"></i><span> Back</span>
                </a>
        
            </div>
        </form>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        $(document).ready(function() {
            if ('{{$attr}}' == 'disabled') {
			    $('#floatingTextarea2').summernote('disable') 
            }
			$('#floatingTextarea2').summernote();
		});
    </script>
@endsection