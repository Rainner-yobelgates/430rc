@extends('admin.layouts')
@section('title', $title)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <form action="{{route('panel.running.update')}}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="card-body">
                <h3 class="fw-bold">{{$title}}</h3>
                @for ($i = 1; $i <= 4; $i++)
                <input type="hidden" name="week{{$i}}" value="Week {{$i}}">
                    <h4 class="fst-italic mb-0 mt-3">Week {{$i}}</h4>
                    <div class="row">
                        @foreach (list_days() as $index => $day)
                        <div class="col-3">
                            <label class="col-form-label">{{ucfirst($day)}}</label>
                            <div class="form-group mb-2">
                                <textarea name="{{$day}}{{$i}}" class="summernote">{{ old($day . $i, $getRunning[$i-1]->description[$index] ?? '-') }}</textarea>
                                @error($day . $i)
                                    <span class="text-danger ms-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>                    
                @endfor
                
                <button type="submit" class="mb-2 mr-2 btn btn-success" title="Save">
                    <i class="fas fa-save"></i><span> Save</span>
                </button>
        </form>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        $(document).ready(function() {
			$('.summernote').summernote({
                height: 120,
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
		});
    </script>
@endsection