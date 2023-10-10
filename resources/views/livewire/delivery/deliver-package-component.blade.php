@section('title', 'Deliver Package')

<div>
	
	<div class="osahan-profile">
		<div class="osahan-header-nav shadow-sm bg-danger p-3 d-flex align-items-center">
			<h5 class="font-weight-normal mb-0 text-white">
				<a wire:navigate class="text-danger mr-3" href="{{ route('all-delivery-orders') }}"><i class="icofont-rounded-left"></i></a>
				Deliver Package
			</h5>
{{--			<div class="ml-auto d-flex align-items-center">--}}
{{--				<a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>--}}
{{--			</div>--}}
		</div>
		
		<div class="px-3 pt-3 pb-5">
			<form action="profile.html">
				<div class="d-flex justify-content-center rounded-2 mb-4">
					<div class="form-profile w-100">
						<div class="text-center mb-3 position-relative">
							<i class="icofont-ui-travel profile-absolute-icon"></i>
						</div>
						<div class="form-group row">
							<div class="col-sm-4 mb-3 mb-sm-0">
								<label class="text-muted f-10 mb-1">Package Name</label>
								<input type="text" class="form-control" placeholder="Enter First Name" wire:model="package_name">
								
								@error('package_name')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							
							<div class="col-sm-4 mb-3 mb-sm-0">
								<label class="text-muted f-10 mb-1">Package Type</label>
								<select class="custom-select" wire:model="package_type">
									<option value="">Select Package Type</option>
									<option value="Document">Document</option>
									<option value="Parcel">Parcel</option>
									<option value="Food">Food</option>
									<option value="Clothes">Clothes</option>
									<option value="Electronics">Electronics</option>
									<option value="Others">Others</option>
								</select>
								
								@error('package_type')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							
							<div class="col-sm-4 mb-3 mb-sm-0">
								<label class="text-muted f-10 mb-1">Package Size</label>
								<select class="custom-select" wire:model="package_size">
									<option value="">Select Package Size</option>
									<option value="Small">Small</option>
									<option value="Medium">Medium</option>
									<option value="Large">Large</option>
								</select>
								
								@error('package_size')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
						</div>
						
						<div class="form-group">
							<label class="text-muted f-10 mb-1">Package Description</label>
							<textarea class="form-control" placeholder="Enter Package Description" wire:model="package_description"></textarea>
							
							@error('package_description')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label class="text-muted f-10 mb-1">Package From</label>
								<select class="custom-select" wire:model="package_from">
									<option value="">Select a station</option>
									@foreach($this->stations as $station)
										<option value="{{ $station->bus_station_name }}" {{ $station->bus_station_name == $this->package_from ? 'selected' : '' }}>
											{{ $station->bus_station_name }}
										</option>
									@endforeach
								</select>
								
								@error('package_from')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label class="text-muted f-10 mb-1">Package To</label>
								<select class="custom-select" wire:model="package_to">
									<option value="">Select a station</option>
									@foreach($this->stations as $station)
										<option value="{{ $station->bus_station_name }}" {{ $station->bus_station_name == $this->package_to ? 'selected' : '' }}>
											{{ $station->bus_station_name }}
										</option>
									@endforeach
								</select>
								
								@error('package_to')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label class="text-muted f-10 mb-1">Sender Name</label>
								<input type="text" class="form-control" placeholder="Enter Sender Name" wire:model="package_sender_name">
								
								@error('package_sender_name')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label class="text-muted f-10 mb-1">Sender Phone</label>
								<input type="text" class="form-control" placeholder="Enter Sender Phone" wire:model="package_sender_phone">
								
								@error('package_sender_phone')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
						</div>
						
						<div class="form-group">
							<label class="text-muted f-10 mb-1">Sender Address</label>
							<textarea class="form-control" placeholder="Enter Sender Address" wire:model="package_sender_address"></textarea>
							
							@error('package_sender_address')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label class="text-muted f-10 mb-1">Receiver Name</label>
								<input type="text" class="form-control" placeholder="Enter Receiver Name" wire:model="package_receiver_name">
								
								@error('package_receiver_name')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
							
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label class="text-muted f-10 mb-1">Receiver Phone</label>
								<input type="text" class="form-control" placeholder="Enter Receiver Phone" wire:model="package_receiver_phone">
								
								@error('package_receiver_phone')
								<span class="text-danger">{{$message}}</span>
								@enderror
							</div>
						</div>
						
						<div class="form-group">
							<label class="text-muted f-10 mb-1">Receiver Address</label>
							<textarea class="form-control" placeholder="Enter Receiver Address" wire:model="package_receiver_address"></textarea>
							
							@error('package_receiver_address')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</div>
						
						
						<div class="mb-5">
							<a href="#!" class="btn btn-danger btn-block osahanbus-btn rounded-1" wire:click.prevent="deliverPackage">
								<i class="icofont-rounded-right"></i> Submit For Delivery
							</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	
</div>
