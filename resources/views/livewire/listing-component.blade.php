@section('title', 'Listing Buses')

<div>
	
	<div class="osahan-listing">
		<div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
			<h5 class="font-weight-normal mb-0 text-white">
				<a class="text-danger" wire:navigate href="{{ route('home') }}"><i class="icofont-rounded-left"></i></a>
			</h5>
{{--			<div class="ml-auto d-flex align-items-center">--}}
{{--				<a href="{{ route('home') }}" class="text-white h6 mb-0"><i class="icofont-search-1"></i></a>--}}
{{--				<a href="#" class="mx-4 text-white h6 mb-0" data-toggle="modal" data-target="#filterModal"><i class="icofont-filter"></i></a>--}}
{{--				<a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>--}}
{{--			</div>--}}
		</div>
		<div class="osahan-listing p-0 m-0 row border-top">
			<div class="p-2 border-bottom w-100">
				<div class="bg-white border border-warning rounded-1 shadow-sm p-2">
					<div class="row mx-0 px-1">
						<div class="col-6 p-0">
							<small class="text-muted mb-1 f-10 pr-1">GOING FROM</small>
							<p class="small mb-0"> {{ $this->city_from }}</p>
						</div>
						<div class="col-6 p-0">
							<small class="text-muted mb-1 f-10 pr-1">GOING TO</small>
							<p class="small mb-0"> {{ $this->city_to }}</p>
						</div>
					</div>
				</div>
			</div>
			
			@forelse($buses as $key => $bus)
				<a wire:navigate href="{{ route('bus', $bus->bus_number) }}" class="text-dark col-6 px-0">
					<div class="list_item_gird m-0 bg-white shadow-sm listing-item border-bottom border-right">
						<div class="px-3 pt-3 tic-div">
							<div class="list-item-img">
								<img src="{{ $bus->bus_image !== null ? asset('storage/'.$bus->bus_image) : asset('assets/img/listing/item1.png')}}" class="img-fluid">
							</div>
							<p class="mb-0 l-hght-10">{{ $bus->bus_name }}</p>
							<span class="text-danger small">
								{{ $bus->bus_route_from }} to {{ $bus->bus_route_to }}
							</span>
							<div class="start-rating small">
								<i class="icofont-star text-danger"></i>
								<i class="icofont-star text-danger"></i>
								<i class="icofont-star text-danger"></i>
								<i class="icofont-star text-danger"></i>
								<i class="icofont-star text-muted"></i>
								<span class="text-dark">4.0</span>
							</div>
						</div>
						<div class="p-3 d-flex">
							<div class="bus_details w-100">
								<div class="d-flex">
									<p><i class="icofont-wind mr-2 text-danger"></i><span class="small">{{ $bus->bus_type }}</span></p>
									<p class="small ml-auto"><i class="icofont-bus mr-2 text-danger"></i>2/1</p>
								</div>
								<div class="d-flex l-hght-10">
									<span class="icofont-clock-time small mr-2 text-danger"></span>
									<div>
										<small class="text-muted mb-2 d-block">Station</small>
										<p class="small">{{ $bus->bus_histories?->first()->currentStation?->bus_station_name ?? 'N/A' }}</p>
									</div>
								</div>
								<div class="d-flex l-hght-10">
									<span class="icofont-google-map small mr-2 text-danger"></span>
									<div>
										<small class="text-muted mb-2 d-block">From - To</small>
										<p class="small mb-1">{{ $bus->bus_route_from }} to {{ $bus->bus_route_to }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			@empty
				<div class="col-12">
					<div class="alert alert-danger">
						No buses found!
					</div>
				</div>
			@endforelse
		</div>
	</div>
	
{{--	<div class="modal fade" id="filterModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">--}}
{{--		<div class="modal-dialog m-0">--}}
{{--			<div class="modal-content modal-content rounded-0 border-0 vh-100">--}}
{{--				<form>--}}
{{--					<div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">--}}
{{--						<h5 class="font-weight-normal mb-0 text-white">--}}
{{--							<a data-dismiss="modal" aria-label="Close" class="text-danger"><i class="icofont-rounded-left mr-3"></i></a>--}}
{{--							Filter By--}}
{{--						</h5>--}}
{{--						<div class="ml-auto d-flex align-items-center">--}}
{{--							<a href="#" class="text-white mr-3">Clear all</a>--}}
{{--							<a class="toggle osahan-toggle h4 m-0 text-white ml-auto hc-nav-trigger hc-nav-1" href="#" role="button" aria-controls="hc-nav-1"><i class="icofont-navigation-menu"></i></a>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					<div class="modal-body p-3">--}}
{{--						<div class="mb-4">--}}
{{--							<div class="d-flex">--}}
{{--								<p class="mb-2 text-dark font-weight-bold">Choose Class</p>--}}
{{--							</div>--}}
{{--							<div class="custom-control custom-radio custom-control-inline">--}}
{{--								<input type="radio" id="customRadioclass1" name="customRadioclass1" class="custom-control-input">--}}
{{--								<label class="custom-control-label small" for="customRadioclass1">AC</label>--}}
{{--							</div>--}}
{{--							<div class="custom-control custom-radio custom-control-inline">--}}
{{--								<input type="radio" id="customRadioclass2" name="customRadioclass1" class="custom-control-input">--}}
{{--								<label class="custom-control-label small" for="customRadioclass2">Non AC</label>--}}
{{--							</div>--}}
{{--							<div class="custom-control custom-radio custom-control-inline">--}}
{{--								<input type="radio" id="customRadioclass3" name="customRadioclass1" class="custom-control-input">--}}
{{--								<label class="custom-control-label small" for="customRadioclass3">Business</label>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--						<div class="mb-4">--}}
{{--							<p class="mb-2 text-dark font-weight-bold">Choose Price</p>--}}
{{--							<div class="custom-control custom-radio custom-control-inline">--}}
{{--								<input type="radio" id="customRadioprice1" name="customRadioprice1" class="custom-control-input">--}}
{{--								<label class="custom-control-label small" for="customRadioprice1">$100 - $200</label>--}}
{{--							</div>--}}
{{--							<div class="custom-control custom-radio custom-control-inline">--}}
{{--								<input type="radio" id="customRadioprice2" name="customRadioprice1" class="custom-control-input">--}}
{{--								<label class="custom-control-label small" for="customRadioprice2">$300 - $400</label>--}}
{{--							</div>--}}
{{--							<div class="custom-control custom-radio custom-control-inline">--}}
{{--								<input type="radio" id="customRadioprice3" name="customRadioprice1" class="custom-control-input">--}}
{{--								<label class="custom-control-label small" for="customRadioprice3">$600 - $800</label>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--						<div class="mb-4">--}}
{{--							<p class="mb-2 text-dark font-weight-bold">Choose Bus Service</p>--}}
{{--							<div class="btn-group btn-group-toggle d-block" data-toggle="buttons">--}}
{{--								<label class="btn btn-chkftr btn-danger small btn-sm rounded mr-2 mb-2">--}}
{{--									<input type="checkbox" name="options" autocomplete="off"> Niloy Poribohon--}}
{{--								</label>--}}
{{--								<label class="btn btn-chkftr btn-danger small btn-sm rounded mr-2 mb-2">--}}
{{--									<input type="checkbox" name="options" autocomplete="off"> Green Wheel--}}
{{--								</label>--}}
{{--								<label class="btn btn-chkftr btn-danger small btn-sm rounded mr-2 mb-2">--}}
{{--									<input type="checkbox" name="options" autocomplete="off"> Parboti Bus--}}
{{--								</label>--}}
{{--								<label class="btn btn-chkftr btn-danger small btn-sm rounded mr-2 mb-2">--}}
{{--									<input type="checkbox" name="options" autocomplete="off"> Night Way--}}
{{--								</label>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					<div class="modal-footer border-0 fixed-bottom">--}}
{{--						<button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger btn-block osahanbus-btn py-3">APPLY FILTER</button>--}}
{{--					</div>--}}
{{--				</form>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--	</div>--}}
	
</div>
