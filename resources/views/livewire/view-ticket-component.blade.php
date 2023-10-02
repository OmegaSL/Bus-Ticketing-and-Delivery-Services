@section('title', 'View Ticket')

<div>
	
	<div class="ticket padding-bt">
		<div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
			<h5 class="font-weight-normal mb-0 text-white">
				<a wire:navigate class="text-danger mr-3" href="{{ route('my-tickets') }}"><i class="icofont-rounded-left"></i></a>
				Ticket
			</h5>
{{--			<div class="ml-auto d-flex align-items-center">--}}
{{--				<a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>--}}
{{--			</div>--}}
		</div>
		
		<div class="your-ticket p-3">
			<h5 class="mb-3 font-weight-bold text-dark">{{ auth()->user()->name }} Travellers ISO 9002 - {{ date('Y') }} Certified</h5>
			<p class="text-success mb-3 font-weight-bold">{{ strtoupper($this->payment->payment_status) }}</p>
			<div class="bg-white border border-warning rounded-1 shadow-sm p-3 mb-3">
				<div class="row mx-0 mb-3">
					<div class="col-6 p-0">
						<small class="text-muted mb-1 f-10 pr-1">GOING FROM</small>
						<p class="small mb-0 l-hght-14"> {{ $this->payment->booking?->booking_from ?? 'N/A' }}</p>
					</div>
					<div class="col-6 p-0">
						<small class="text-muted mb-1 f-10 pr-1">GOING TO</small>
						<p class="small mb-0 l-hght-14"> {{ $this->payment->booking?->booking_to ?? 'N/A' }}</p>
					</div>
				</div>
				<div class="row mx-0">
					<div class="col-6 p-0">
						<small class="text-muted mb-1 f-10 pr-1">DATE OF JOURNEY</small>
						<p class="small mb-0 l-hght-14"> {{ date('d M, Y', strtotime($this->payment->booking?->departure_date_time)) }}</p>
					</div>
					<div class="col-6 p-0">
						<small class="text-muted mb-1 f-10 pr-1">YOU RATED</small>
						<p class="small mb-0 l-hght-14"><span class="icofont-star text-warning"></span> 3.5</p>
					</div>
				</div>
			</div>
			<div class="bg-white rounded-1 shadow-sm p-3 mb-3 w-100">
				<div class="row mx-0">
					<div class="col-12 p-0 mb-3">
						<small class="text-danger mb-1 f-10 pr-1">Current Station</small>
						<p class="small mb-0 l-hght-14"> {{ $this->payment->booking?->departure_station?->bus_station_name ?? 'N/A' }}</p>
					</div>
					<div class="col-12 p-0">
						<small class="text-danger mb-1 f-10 pr-1">Destination Station</small>
						<p class="small mb-0 l-hght-14">{{ $this->payment->booking?->arrival_station?->bus_station_name ?? 'N/A' }}</p>
					</div>
				</div>
			</div>
{{--			<div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm mb-3">--}}
{{--				<div class="d-flex mb-auto">--}}
{{--					<span class="icofont-location-pin h4"></span>--}}
{{--				</div>--}}
{{--				<div class="d-flex w-100">--}}
{{--					<div class="bus_details w-100 pl-3">--}}
{{--						<p class="mb-2 l-hght-18 font-weight-bold">View Boarding Location on Map</p>--}}
{{--						<div class="d-flex align-items-center mt-2">--}}
{{--							<small class="text-muted mb-0 pr-1">Akshya Nagar 1st Block 1st Cross, Rammurthy<br>Nagar, Bangalore <br>560016--}}
{{--							</small>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
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
							<p class="small mb-0 ml-auto l-hght-14"> {{ $this->payment_id }}</p>
						</div>
						<div class="l-hght-10 d-flex align-items-center my-2">
							<small class="text-muted mb-0 pr-1">Seats</small>
{{--							@dd($this->payment->booking->seat_allocations->seat())--}}
							@php
								$seats_id = [];
								foreach($this->payment->booking->seat_allocations as $seat_allocation) {
									$seats_id[] = $seat_allocation->seat_id;
								}
								$seats = \App\Models\Seat::whereIn('id', $seats_id)->pluck('seat_number')->toArray();
							@endphp
							@if($seats)
								<p class="small mb-0 ml-auto l-hght-14">
									{{ implode(', ', $seats) }}
								</p>
							@endif
						</div>
						<div class="l-hght-10 d-flex align-items-center mt-3">
							<p class="mb-0 pr-1 font-weight-bold">Amount Paid</p>
							<p class="mb-0 ml-auto l-hght-14 text-danger font-weight-bold">Ghc {{ $this->payment->payment_amount }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="fixed-bottom p-3">
		<div class="footer-menu row m-0 px-1 bg-white shadow rounded-2">
			<div class="col-4 p-0 text-center">
				<a href="profile.html" class="home text-danger py-3">
					<span class="icofont-file-pdf h5"></span>
					<p class="mb-0 small">Download Pdf</p>
				</a>
			</div>
			<div class="col-4 p-0 text-center">
				<a href="profile.html" class="home text-danger">
					<span class="icofont-dropbox h5"></span>
					<p class="mb-0 small">Dropbox Drive</p>
				</a>
			</div>
			<div class="col-4 p-0 text-center">
				<a href="profile.html" class="home text-danger">
					<span class="icofont-share h5"></span>
					<p class="mb-0 small">Share Ticket</p>
				</a>
			</div>
		</div>
	</div>
	
</div>
