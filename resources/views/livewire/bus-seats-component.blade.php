@section('title', 'Bus Seats')

<div>
	
	<div class="seat-select padding-bt">
		<div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
			<h5 class="font-weight-normal mb-0 text-white">
				<a wire:navigate class="text-danger mr-3" href="{{ route('bus', $this->bus_number) }}"><i
							class="icofont-rounded-left"></i></a>
				Bus Seat Select
			</h5>
			{{--			<div class="ml-auto d-flex align-items-center">--}}
			{{--				<a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>--}}
			{{--			</div>--}}
		</div>
		
		<div class="ticket p-3">
			<h6 class="mb-1 font-weight-bold text-dark">{{ auth()->user()->full_name }}</h6>
			<div class="start-rating f-10 mb-3">
				<i class="icofont-star text-danger"></i>
				<i class="icofont-star text-danger"></i>
				<i class="icofont-star text-danger"></i>
				<i class="icofont-star text-danger"></i>
				<i class="icofont-star text-muted"></i>
				<span class="text-dark">4.0</span>
			</div>
			<div class="bg-white rounded-1 shadow-sm p-3 mb-3 w-100">
				<div class="row mx-0 mb-3">
					<div class="col-12 p-0">
						<small class="text-muted mb-1 f-10 pr-1">Amenities</small>
					</div>
					@foreach(array_slice($this->bus->bus_amenities, 2, 2) as $amenity)
						<div class="col-6 p-0">
							<small class="text-muted mb-1 f-10 pr-1">{{ $amenity }}</small>
							<p class="small mb-0 l-hght-14"> Yes</p>
						</div>
					@endforeach
				</div>
				<div class="row mx-0 mb-3">
					@foreach(array_slice($this->bus->bus_amenities, 4, 2) as $amenity)
						<div class="col-6 p-0">
							<small class="text-muted mb-1 f-10 pr-1">{{ $amenity }}</small>
							<p class="small mb-0 l-hght-14"> Yes</p>
						</div>
					@endforeach
				</div>
				<div class="row mx-0">
					@foreach(array_slice($this->bus->bus_amenities, 6, 2) as $amenity)
						<div class="col-6 p-0">
							<small class="text-muted mb-1 f-10 pr-1">{{ $amenity }}</small>
							<p class="small mb-0 l-hght-14"> Yes</p>
						</div>
					@endforeach
				</div>
			</div>
			
			<div class="select-seat row bg-white mx-0 px-3 pt-3 pb-1 mb-3 rounded-1 shadow-sm">
				<div class="col-8 pl-0">
					<div class="d-flex">
						<div class="sold text-center">
							<img src="{{asset('assets/img/sold-seat.png')}}" class="img-fluid mb-1">
							<p class="small f-10">Sold Out</p>
						</div>
						<div class="sold text-center mx-3">
							<img src="{{asset('assets/img/available-seat.png')}}" class="img-fluid mb-1">
							<p class="small f-10">Available</p>
						</div>
						<div class="sold text-center">
							<img src="{{asset('assets/img/selected-seat.png')}}" class="img-fluid mb-1">
							<p class="small f-10">Selected</p>
						</div>
					</div>
					<div class="select-seat">
						<div class="checkboxes-seat mt-4">
							@php
								$seats = \App\Models\Seat::where('bus_id', $this->bus->id)->get()->take(16); // Retrieve all seats from the database
								$seatChunks = $seats->chunk(2); // Split the seats into pairs (two per row)
							@endphp
							@foreach ($seatChunks as $pair)
								<div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">
									@foreach ($pair as $seats)
										@php
											$isAvailable = $seats->seat_status; // Replace with your actual availability check logic
											$class = $isAvailable === 'Booked' ? 'btn-danger active' : 'btn-success';
											$isActive = in_array($seats->seat_number, $this->selectedSeats, true) ? 'active' : '';
										@endphp
										
										<label wire:click="toggleSeat('{{ $seats->seat_number }}')"
										       class="btn check-seat small btn-sm rounded mr-2 mb-2 {{ $class }} {{ $isActive }}"
										       style="pointer-events: {{ $isAvailable === 'Booked' ? 'none' : 'auto' }}">
											<input type="checkbox" name="{{ $seats->seat_number }}"
											       value="{{ $seats->seat_number }}" autocomplete="off"
											       wire:model.live="selectedSeats">
											{{ $seats->seat_number }}
										</label>
									@endforeach
								</div>
							@endforeach
						</div>
					</div>
				</div>
{{--				<div class="col-4 text-right pr-0">--}}
{{--					<img src="img/driver.png" class="img-fluid mb-4">--}}
{{--					<div class="checkboxes-seat mt-4">--}}
{{--						<div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">--}}
{{--							<label class="btn check-seat btn-success small btn-sm rounded mb-2">--}}
{{--								<input type="checkbox" name="a3" autocomplete="off">--}}
{{--								A3--}}
{{--							</label>--}}
{{--						</div>--}}
{{--						<div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">--}}
{{--							<label class="btn check-seat btn-success small btn-sm rounded mb-2">--}}
{{--								<input type="checkbox" name="b3" autocomplete="off">--}}
{{--								B3--}}
{{--							</label>--}}
{{--						</div>--}}
{{--						<div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">--}}
{{--							<label class="btn check-seat btn-danger small btn-sm rounded mb-2">--}}
{{--								<input type="checkbox" name="c3" autocomplete="off" checked disabled>--}}
{{--								C3--}}
{{--							</label>--}}
{{--						</div>--}}
{{--						<div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">--}}
{{--							<label class="btn check-seat btn-danger small btn-sm rounded mb-2">--}}
{{--								<input type="checkbox" name="d3" autocomplete="off" checked disabled>--}}
{{--								D3--}}
{{--							</label>--}}
{{--						</div>--}}
{{--						<div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">--}}
{{--							<label class="btn check-seat btn-success small btn-sm rounded mb-2">--}}
{{--								<input type="checkbox" name="e3" autocomplete="off">--}}
{{--								E3--}}
{{--							</label>--}}
{{--						</div>--}}
{{--						<div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">--}}
{{--							<label class="btn check-seat btn-success small btn-sm rounded mb-2">--}}
{{--								<input type="checkbox" name="f3" autocomplete="off">--}}
{{--								F3--}}
{{--							</label>--}}
{{--						</div>--}}
{{--						<div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">--}}
{{--							<label class="btn check-seat btn-success small btn-sm rounded mb-2">--}}
{{--								<input type="checkbox" name="g3" autocomplete="off">--}}
{{--								G3--}}
{{--							</label>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
			</div>
			<div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm">
				<div class="d-flex mb-auto">
					<img src="{{asset('assets/img/qr-code.png')}}" class="img-fluid osahan-qr">
				</div>
				<div class="d-flex w-100">
					<div class="bus_details w-100 pl-3">
						<p class="mb-2 l-hght-18 font-weight-bold">More info.</p>
						<div class="l-hght-10 d-flex align-items-center my-2">
							<small class="text-muted mb-0 pr-1">Passenger</small>
							<p class="small mb-0 ml-auto l-hght-14"> {{ auth()->user()->full_name }}</p>
						</div>
						<div class="l-hght-10 d-flex align-items-center my-2">
							<small class="text-muted mb-0 pr-1">Ticket Number</small>
							<p class="small mb-0 ml-auto l-hght-14">
{{--								{{ $this->bus->bus_histories->count() }}--}}
								Make Payment to get Ticket Number
							</p>
						</div>
{{--						<div class="l-hght-10 d-flex align-items-center my-2">--}}
{{--							<small class="text-muted mb-0 pr-1">PNR Number</small>--}}
{{--							<p class="small mb-0 ml-auto l-hght-14"> 56276-32324</p>--}}
{{--						</div>--}}
						<div class="l-hght-10 d-flex align-items-center mt-3">
							<p class="mb-0 pr-1 font-weight-bold">Amount Paid</p>
							<p class="mb-0 ml-auto l-hght-14 text-danger font-weight-bold">
								Ghc {{ $this->bus->bus_route_price }}
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="fixed-bottom view-seatbt p-3">
		<a wire:click="makePayment" href="#!" class="btn btn-danger btn-block d-flex align-items-center osahanbus-btn rounded-1 {{ count($this->selectedSeats) < 1 ? 'disabled' : ''}}">
			<span class="text-left l-hght-14">
			TOTAL Ghc {{ $this->bus->bus_route_price }}<br>
			<small class="f-10 text-white-50">
				Seats Selected : {{ count($this->selectedSeats) }}
			</small>
			</span>
			<span class="font-weight-bold ml-auto">NEXT</span>
		</a>
	</div>

</div>
