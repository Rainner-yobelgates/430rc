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
                <form action="{{route('panel.product.attribute.store', $product->id)}}" method="post" enctype="multipart/form-data">
            @elseif($viewType == 'edit')
                <form action="{{route('panel.product.attribute.update', [$product->id, $attribute->id])}}" method="post" enctype="multipart/form-data">
                @method('patch')
            @endif
            @csrf
            <div class="card-header">
                <h5>{{$title}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Color <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="color_id" class="form-control" {{$attr}}>
                            @forelse ($getColor as $key => $color)
                            <option value="{{ $key }}" {{isset($attribute->color_id) && $key == $attribute->color_id ? 'selected' : ''}} >{{ ucfirst($color) }}</option>
                            @empty
                            <option value="">No Color Data</option>
                            @endforelse
                        </select>
                        @error('color_id')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Size <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="size" class="form-control" {{$attr}}>
                            @foreach (list_size_product() as $item)
                            <option value="{{ $item }}" {{isset($attribute->size) && $item == $attribute->size ? 'selected' : ''}}>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('size')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control" {{$attr}}>
                            @foreach (get_list_status() as $key => $item)
                            <option value="{{ $key }}" {{isset($attribute->status) && $key == $attribute->status ? 'selected' : ''}}>{{ $item }}</option>
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
                    <a href="{{route('panel.product.attribute.edit', [$product->id, $attribute->id])}}" class="mb-2 mr-2 btn btn-primary"
                        title="Back">
                        <i class="fas fa-edit"></i><span> Edit</span>
                    </a>
                @endif
                <a href="{{route('panel.product.show', $product->id)}}" class="mb-2 mr-2 btn btn-warning"
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