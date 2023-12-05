@extends('admin.layouts')
@section('title', $title)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <form action="{{route('panel.setting.update')}}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="card-body">
                <h5>{{$title}}</h5>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Banner Header</label>
                    <div class="col-sm-10">
                        @isset($settings['header'])
                        <div class="mb-2 border" style="width: 200px">
                            <img src="{{asset('storage/'. $settings['header'])}}" class="img-fluid" style="object-fit: contain;" alt="user photo">
                        </div> 
                        @endisset
                        <input type="file" name="header" class="form-control">
                        @error('header')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Title Header</label>
                    <div class="col-sm-10">
                        <input type="text" name="title-header" value="{{ old('title-header', $settings['title-header'] ?? '') }}"  class="form-control"
                        placeholder="Input Title Header Field">
                        @error('title-header')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Sub Title Header</label>
                    <div class="col-sm-10">
                        <input type="text" name="sub-title-header" value="{{ old('sub-title-header', $settings['sub-title-header'] ?? '') }}"  class="form-control"
                        placeholder="Input Sub Title Header Field">
                        @error('sub-title-header')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Text Header</label>
                    <div class="col-sm-10">
                        <input type="text" name="text-header" value="{{ old('text-header', $settings['text-header'] ?? '') }}"  class="form-control"
                        placeholder="Input Text Header Field">
                        @error('text-header')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Banner Motivation</label>
                    <div class="col-sm-10">
                        @isset($settings['motivation'])
                        <div class="mb-2 border" style="width: 200px">
                            <img src="{{asset('storage/'. $settings['motivation'])}}" class="img-fluid" style="object-fit: contain;" alt="user photo">
                        </div> 
                        @endisset
                        <input type="file" name="motivation" class="form-control">
                        @error('motivation')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Instagram</label>
                    <div class="col-sm-10">
                        <input type="text" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}"  class="form-control"
                        placeholder="Input Instagram Field">
                        @error('instagram')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Tiktok</label>
                    <div class="col-sm-10">
                        <input type="text" name="tiktok" value="{{ old('tiktok', $settings['tiktok'] ?? '') }}"  class="form-control"
                        placeholder="Input Tiktok Field">
                        @error('tiktok')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Whatsapp</label>
                    <div class="col-sm-10">
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}"  class="form-control"
                        placeholder="Input Whatsapp Field">
                        @error('whatsapp')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Strava</label>
                    <div class="col-sm-10">
                        <input type="text" name="strava" value="{{ old('strava', $settings['strava'] ?? '') }}"  class="form-control"
                        placeholder="Input Strava Field">
                        @error('strava')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                        <input type="text" name="location" value="{{ old('location', $settings['location'] ?? '') }}"  class="form-control"
                        placeholder="Input Location Field">
                        @error('location')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">City</label>
                    <div class="col-sm-10">
                    <select name="city" id="city" class="form-control">
                        @foreach ($getCity as $key => $city)
                        <option value="{{ $key }}" {{isset($settings['city']) && $key == $settings['city'] ? 'selected' : ''}}>{{ $city }}</option>
                        @endforeach
                        @error('city')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </select>
                    </div>
                </div>
                <hr class="my-4">
                <h5>Our History Page</h5>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">About Image</label>
                    <div class="col-sm-10">
                        @isset($settings['about-image'])
                        <div class="mb-2 border" style="width: 200px">
                            <img src="{{asset('storage/'. $settings['about-image'])}}" class="img-fluid" style="object-fit: contain;" alt="user photo">
                        </div> 
                        @endisset
                        <input type="file" name="about-image" class="form-control">
                        @error('about-image')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">About Content</label>
                    <div class="col-sm-10">
                        <textarea name="about-content" class="summernote">{{ old('about-content', $settings['about-content'] ?? '') }}</textarea>
                        @error('about-content')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <hr class="my-4">
                <h5>Our Program Page</h5>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Running Plan Video</label>
                    <div class="col-sm-10">
                        @isset($settings['running-video'])
                        <video width="240" height="180" controls>
                            <source src="{{ asset('storage/'. $settings['running-video']) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @endisset
                        <input type="file" name="running-video" class="form-control" accept="video/*">
                        @error('running-video')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Running Plan Information</label>
                    <div class="col-sm-10">
                        <textarea name="running-information" class="summernote">{{ old('running-information', $settings['running-information'] ?? '') }}</textarea>
                        @error('running-information')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Running Plan Disclaimer</label>
                    <div class="col-sm-10">
                        <textarea name="running-disclaimer" class="summernote">{{ old('running-disclaimer', $settings['running-disclaimer'] ?? '') }}</textarea>
                        @error('running-disclaimer')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Workout Plan Video</label>
                    <div class="col-sm-10">
                        @isset($settings['workout-video'])
                        <video width="240" height="180" controls>
                            <source src="{{ asset('storage/'. $settings['workout-video']) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @endisset
                        <input type="file" name="workout-video" class="form-control" accept="video/*">
                        @error('workout-video')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Workout Plan Information</label>
                    <div class="col-sm-10">
                        <textarea name="workout-information" class="summernote">{{ old('workout-information', $settings['workout-information'] ?? '') }}</textarea>
                        @error('workout-information')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label">Workout Plan Disclaimer</label>
                    <div class="col-sm-10">
                        <textarea name="workout-disclaimer" class="summernote">{{ old('workout-disclaimer', $settings['workout-disclaimer'] ?? '') }}</textarea>
                        @error('workout-disclaimer')
                            <span class="text-danger ms-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="mb-2 mr-2 btn btn-success" title="Save">
                    <i class="fas fa-save"></i><span> Save</span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        $(document).ready(function() {
			$('.summernote').summernote();
		});
    </script>
@endsection