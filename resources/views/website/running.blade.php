@extends('website.layouts')
@section('title', 'Running Program')
@section('content')

<section class="running-video mt-5">
    <div class="container mt-4">
        <div class="row">
            <h1 class="text-center fw-bold mb-3">Our Program</h1>
            <video autoplay loop muted style="width: 80%;height: 10%;" class="mx-auto">
                <source src="{{ asset('storage/'. $setting['running-video']) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>
<section class="week-program mt-4">
    <div class="container">
        <div class="row">
            <h4 class="fw-bold">Training Plan For Running</h4>
            @if (isset($getRunning))
            @for ($i = 1; $i <= 4; $i++)
            <h5 class="fst-italic mt-3">Week {{$i}}</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                      <tr class="text-center">
                        <th scope="col">Monday</th>
                        <th scope="col">Tuesday</th>
                        <th scope="col">Wednesday</th>
                        <th scope="col">Thursday</th>
                        <th scope="col">Friday</th>
                        <th scope="col">Saturday</th>
                        <th scope="col">Sunday</th>
                      </tr>
                    </thead>
                    <tbody class="table-light">
                      <tr>
                        @if (isset($getRunning[$i-1]))
                          @foreach ($getRunning[$i-1]->description as $desc)
                          <td scope="row" class="text-center">
                              <p class="fw-bold mb-0">Warming up</p>
                              <p class="fw-bold">Dynamic Screching</p>
                              <hr>
                              {!!$desc!!}
                              <hr>
                              <p class="fw-bold">Cooling down</p>
                          </td>
                          @endforeach                            
                        @endif
                      </tr>
                    </tbody>
                  </table>
            </div>
            @endfor
            @endif
        </div>
    </div>
</section>
<section class="information mt-4">
<div class="container">
  <div class="row">
    <div class="col-12 col-md-7">
      <div class="card p-4 shadow-sm" style="border-radius: 25px">
        <h3 class="text-center">For Your Information</h3>
        {!!$setting['running-information']!!}
      </div>
    </div>
    <div class="col-12 col-md-5 mt-4 mt-sm-0">
      <div class="card p-4 shadow-sm" style="border-radius: 25px">
        <h3 class="text-center">Disclaimer</h3>
        {!!$setting['running-disclaimer']!!}
      </div>
    </div>
  </div>
</div>
</section>
@stop