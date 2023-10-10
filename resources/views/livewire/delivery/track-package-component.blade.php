@section('title', 'Track Package')

<div>
	
	
	<div class="osahan-notification padding-bt">
		<div class="osahan-header-nav shadow-sm bg-danger p-3 d-flex align-items-center">
			<h5 class="font-weight-normal mb-0 text-white">
				<a wire:navigate class="text-danger mr-3" href="{{ route('all-delivery-orders') }}"><i class="icofont-rounded-left"></i></a>
				Track Package ({{ $delivery->delivery_code }})
			</h5>
{{--			<div class="ml-auto d-flex align-items-center">--}}
{{--				<a href="#" class="text-white mr-3">Clear</a>--}}
{{--				<a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>--}}
{{--			</div>--}}
		</div>
		
		<div class="osahan-notification">
			<div class="notification d-flex m-0 bg-white border-bottom p-3">
				<div class="icon pr-3">
					@if($delivery->delivery_status == 'pending')
						<span class="icofont-truck-loaded bg-warning text-dark mb-0 rounded-pill"></span>
					@elseif($delivery->delivery_status == 'processing')
						<span class="icofont-truck-loaded bg-warning text-dark mb-0 rounded-pill"></span>
					@elseif($delivery->delivery_status == 'on-transit')
						<span class="icofont-truck-loaded bg-warning text-dark mb-0 rounded-pill"></span>
					@elseif($delivery->delivery_status == 'delivered')
					<span class="icofont-check-alt bg-success text-white mb-0 rounded-pill"></span>
					@elseif($delivery->delivery_status == 'cancelled')
						<span class="icofont-close bg-danger text-white mb-0 rounded-pill"></span>
					@endif
				</div>
				<div class="noti-details l-hght-18 pr-0">
					<p class="mb-1">
						@if($delivery->delivery_status == 'pending')
							Your package is pending
						@elseif($delivery->delivery_status == 'processing')
							Your package is processing
						@elseif($delivery->delivery_status == 'on-transit')
							Your package is on transit
						@elseif($delivery->delivery_status == 'delivered')
							Your package is delivered
						@elseif($delivery->delivery_status == 'cancelled')
							Your package is cancelled
						@endif
					</p>
					<span class="small text-muted">
						@if($delivery->delivery_status == 'pending')
							Your package is pending from {{ $delivery->package?->package_from }}
						@elseif($delivery->delivery_status == 'processing')
							Your package is being processed from {{ $delivery->package?->package_from }}
						@elseif($delivery->delivery_status == 'on-transit')
							Your package is on transit from {{ $delivery->package?->package_from }} to {{ $delivery->package?->package_to }}
						@elseif($delivery->delivery_status == 'delivered')
							Your package is delivered to {{ $delivery->package?->package_to }}
						@elseif($delivery->delivery_status == 'cancelled')
							Your package is cancelled from {{ $delivery->package?->package_from }}
						@endif
					</span>
				</div>
{{--				<div class="f-10 px-0 text-right">--}}
{{--					<span> &nbsp;&nbsp;&nbsp;&nbsp;  {{ date('H:i A', strtotime($delivery->updated_at)) }}</span>--}}
{{--				</div>--}}
			</div>
			
			@if($delivery->delivery_current_location)
				<div class="notification d-flex m-0 bg-white border-bottom p-3">
					<div class="icon pr-3">
						<span class="icofont-truck-loaded bg-warning text-dark mb-0 rounded-pill"></span>
					</div>
					<div class="noti-details l-hght-18 pr-0">
						<p class="mb-1">Current Location</p>
						<span class="small text-muted">{{ $delivery->delivery_current_location }}</span>
					</div>
					<div class="f-10 px-0 text-right">
						<span> &nbsp;&nbsp;&nbsp;&nbsp; {{ date('H:i A', strtotime($delivery->updated_at)) }}</span>
					</div>
				</div>
			@endif
			
			@if($delivery->delivery_last_location)
				<div class="notification d-flex m-0 bg-white border-bottom p-3">
					<div class="icon pr-3">
						<span class="icofont-gift bg-warning text-dark mb-0 rounded-pill"></span>
					</div>
					<div class="noti-details l-hght-18 pr-0">
						<p class="mb-1">Last Known Location</p>
						<span class="small text-muted">{{ $delivery->delivery_last_location }}</span>
					</div>
					<div class="f-10 px-0 text-right">
						<span> &nbsp;&nbsp;&nbsp;&nbsp; {{ date('H:i A', strtotime($delivery->created_at)) }}</span>
					</div>
				</div>
			@endif
		</div>
	</div>

</div>
