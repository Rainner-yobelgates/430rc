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
                <form action="{{route('panel.voucher.store')}}" method="post" enctype="multipart/form-data">
            @elseif($viewType == 'edit')
                <form action="{{route('panel.voucher.update', $voucher->id)}}" method="post" enctype="multipart/form-data">
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
                        <input type="text" name="name" value="{{ old('name', $voucher->name ?? '') }}"  class="form-control"
                        placeholder="Input Name Field" {{$attr}}>
                        @error('name')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Code <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="code" value="{{ old('code', $voucher->code ?? '') }}"  class="form-control"
                        placeholder="Input Code Field" {{$attr}}>
                        @error('code')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">amount <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="amount" value="{{ old('amount', $voucher->amount ?? '') }}"  class="form-control"
                        placeholder="Input Amount Field" {{$attr}}>
                        @error('amount')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control" {{$attr}}>
                            @foreach (get_list_status() as $key => $item)
                            <option value="{{ $key }}" {{isset($voucher->status) && $key == $voucher->status ? 'selected' : ''}}>{{ $item }}</option>
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
                    <a href="{{route('panel.voucher.edit', $voucher->id)}}" class="mb-2 mr-2 btn btn-primary"
                        title="Back">
                        <i class="fas fa-edit"></i><span> Edit</span>
                    </a>
                @endif
                <a href="{{route('panel.voucher.index')}}" class="mb-2 mr-2 btn btn-warning"
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