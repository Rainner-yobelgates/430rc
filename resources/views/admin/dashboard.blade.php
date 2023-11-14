@extends('admin.layouts')
@section('title', 'Dashboard')
@section('content')
<h1 class="h3 mb-3"><strong>Dashboard</strong> </h1>

<div class="row">
	<div class="col-xl-12 d-flex">
		<div class="w-100">
			<div class="row">
				<div class="col-sm-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Product</h5>
								</div>

								<div class="col-auto">
									<div class="stat text-primary">
										<i class="fa-solid fa-box"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3">{{$countProduct}}</h1>
						</div>
					</div>										
				</div>
				<div class="col-sm-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Gallery</h5>
								</div>

								<div class="col-auto">
									<div class="stat text-primary">
										<i class="fa-solid fa-image"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3">{{$countGallery}}</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">FAQ</h5>
								</div>

								<div class="col-auto">
									<div class="stat text-primary">
										<i class="fa-solid fa-question-circle"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3">{{$countFaq}}</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Color</h5>
								</div>

								<div class="col-auto">
									<div class="stat text-primary">
										<i class="fa-solid fa-droplet"></i>
									</div>
								</div>
							</div>
							<h1 class="mt-1 mb-3">{{$countColor}}</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
		<div class="card flex-fill">
			<div class="card-header mb-0">
				<h5 class="card-title mb-0">Calendar</h5>
			</div>
			<div class="card-body d-flex">
				<div class="align-self-center w-100">
					<div class="chart">
						<div id="datetimepicker-dashboard"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop