<div>
	
	<div class="osahan-verification padding-bt">
		<div class="p-3 shadow bg-danger danger-nav osahan-home-header">
			<div class="font-weight-normal mb-0 d-flex align-items-center">
				<img src="{{ asset('assets/img/logo.png') }}" class="img-fluid osahan-nav-logo">
				<div class="ml-auto d-flex align-items-center">
					<a href="#!" class="mr-3">
						<img src="{{ asset('assets/img/user1.jpg') }}" class="img-fluid rounded-circle">
					</a>
{{--					<a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#">--}}
{{--						<i class="icofont-navigation-menu"></i>--}}
{{--					</a>--}}
				</div>
			</div>
		</div>
		<div class="bg-danger px-3 pb-3">
			<div class="bg-white rounded-1 p-3">
				<form wire:submit.prevent="searchRide">
					<div class="form-group border-bottom pb-2">
						<label for="exampleFormControlSelect1" class="mb-2"><span class="icofont-search-map text-danger"></span> From</label><br>
						<select class="js-example-basic-single form-control" name="city_from" wire:model.live="city_from">
							<option value="">Select a city</option>
							@foreach($this->cities['cities'] as $city)
								<option value="{{ $city }}" {{ $this->city_to === $city ? 'disabled' : '' }}>
									{{ $city }}
								</option>
							@endforeach
						</select>
						
						@error('city_from')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group border-bottom pb-2">
						<label for="exampleFormControlSelect1" class="mb-2"><span class="icofont-google-map text-danger"></span> To</label><br>
						<select class="js-example-basic-single form-control" name="city_to" wire:model.live="city_to">
							<option value="">Select a city</option>
							@foreach($this->cities['cities'] as $city)
								<option value="{{ $city }}" {{ $this->city_from === $city ? 'disabled' : '' }}>
									{{ $city }}
								</option>
							@endforeach
						</select>
						
						@error('city_to')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group border-bottom pb-1">
						<label for="exampleFormControlSelect1" class="mb-2"><span class="icofont-ui-calendar text-danger"></span> Date</label><br>
						<input name="date" class="form-control border-0 p-0" type="date" min="{{ date('Y-m-d') }}" wire:model.blur="travel_date">
						
						@error('travel_date')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<button type="submit" class="btn btn-danger btn-block osahanbus-btn rounded-1">Search</button>
				</form>
			</div>
		</div>
		<div class="p-3 bg-warning">
			<div class="row m-0">
				<div class="col-6 py-1 pr-1 pl-0">
					<div class="p-3 bg-white shadow-sm rounded-1">
						<img class="img-fluid" src="{{asset('assets/img/safe-vehicles.svg')}}" alt="">
						<p class="mb-0 mt-4 font-weight-bold">Safe and Hygenic<br>Vehicles</p>
					</div>
				</div>
				<div class="col-6 py-1 pl-1 pr-0">
					<div class="p-3 bg-white shadow-sm rounded-1">
						<img class="img-fluid" src="{{asset('assets/img/customer-support.svg')}}" alt="">
						<p class="mb-0 mt-4 font-weight-bold">Best Customer<br>Support</p>
					</div>
				</div>
				<div class="col-6 py-1 pr-1 pl-0">
					<div class="p-3 bg-white shadow-sm rounded-1">
						<img class="img-fluid" src="{{asset('assets/img/live-tracking.svg')}}" alt="">
						<p class="mb-0 mt-4 font-weight-bold">Live Track your<br>Journey</p>
					</div>
				</div>
				<div class="col-6 py-1 pl-1 pr-0">
					<div class="p-3 bg-white shadow-sm rounded-1">
						<img class="img-fluid" src="{{asset('assets/img/verified-drivers.svg')}}" alt="">
						<p class="mb-0 mt-4 font-weight-bold">Verified Drivers<br>and Vehicles</p>
					</div>
				</div>
			</div>
		</div>
		<div class="p-3">
			<h6 class="text-center">Bus Discounts For You</h6>
			<div class="row m-0">
				<div class="col-6 py-1 pr-1 pl-0">
					<a href="#!">
						<img class="img-fluid rounded-1 shadow-sm" src="{{asset('assets/img/offer1.jpg')}}" alt="">
					</a>
				</div>
				<div class="col-6 py-1 pl-1 pr-0">
					<a href="#!">
						<img class="img-fluid rounded-1 shadow-sm" src="{{asset('assets/img/offer2.jpg')}}" alt="">
					</a>
				</div>
				<div class="col-6 py-1 pr-1 pl-0">
					<a href="#!">
						<img class="img-fluid rounded-1 shadow-sm" src="{{asset('assets/img/offer3.jpg')}}" alt="">
					</a>
				</div>
				<div class="col-6 py-1 pl-1 pr-0">
					<a href="#!">
						<img class="img-fluid rounded-1 shadow-sm" src="{{asset('assets/img/offer4.jpg')}}" alt="">
					</a>
				</div>
			</div>
		</div>
	</div>
	
</div>
