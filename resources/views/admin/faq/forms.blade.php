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
                <form action="{{route('panel.faq.store')}}" method="post" enctype="multipart/form-data">
            @elseif($viewType == 'edit')
                <form action="{{route('panel.faq.update', $faq->id)}}" method="post" enctype="multipart/form-data">
                @method('patch')
            @endif
            @csrf
            <div class="card-header">
                <h5>{{$title}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" name="title" value="{{ old('title', $faq->title ?? '') }}"  class="form-control"
                        placeholder="Input Title Field" {{$attr}}>
                        @error('title')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Content <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="" id="floatingTextarea2" name="content" style="height: 100px" {{$attr}}>{{$faq->content ?? ''}}</textarea>
                            <label for="floatingTextarea2">Input Content Field</label>
                        </div>
                        @error('content')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Order <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="number" name="order" value="{{ old('order', $faq->order ?? '') }}"  class="form-control"
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
                    <a href="{{route('panel.faq.edit', $faq->id)}}" class="mb-2 mr-2 btn btn-primary"
                        title="Back">
                        <i class="fas fa-edit"></i><span> Edit</span>
                    </a>
                @endif
                <a href="{{route('panel.faq.index')}}" class="mb-2 mr-2 btn btn-warning"
                   title="Back">
                    <i class="fas fa-arrow-left"></i><span> Back</span>
                </a>
        
            </div>
        </form>
        </div>
    </div>
</div>
@stop