@section('title', 'Profile')

<div>
	
	<div class="osahan-profile">
		<div class="osahan-header-nav shadow-sm bg-danger p-3 d-flex align-items-center">
			<h5 class="font-weight-normal mb-0 text-white">
				<a class="text-danger mr-3" href="home.html"><i class="icofont-rounded-left"></i></a>
				My Profile
			</h5>
			<div class="ml-auto d-flex align-items-center">
				<a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
			</div>
		</div>
		
		<div class="px-3 pt-3 pb-5">
			<form action="profile.html">
				<div class="d-flex justify-content-center rounded-2 mb-4">
					<div class="form-profile w-100">
						<div class="text-center mb-3 position-relative">
{{--							<div class="position-absolute edit-bt">--}}
{{--								<label for="upload-photo" class="mb-0"><span class="icofont-pencil-alt-5 text-white"></span></label>--}}
{{--								<input type="file" name="photo" id="upload-photo" />--}}
{{--							</div>--}}
							<img src="{{asset('assets/img/profile.jpg')}}" class="rounded-pill">
						</div>
						<div class="form-group">
							<label class="text-muted f-10 mb-1">First Name</label>
							<input type="text" class="form-control" placeholder="Enter First Name" wire:model="first_name">
							
							@error('first_name')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</div>
						<div class="form-group">
							<label class="text-muted f-10 mb-1">Last Name</label>
							<input type="text" class="form-control" placeholder="Enter Last Name" wire:model="last_name">
							
							@error('last_name')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</div>
						<div class="form-group">
							<label class="text-muted f-10 mb-1">Mobile Number</label>
							<input type="text" class="form-control" placeholder="Enter Mobile Number" wire:model="phone_number">
							
							@error('phone_number')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</div>
						<div class="form-group">
							<label class="text-muted f-10 mb-1">Your Email</label>
							<input type="email" class="form-control" placeholder="Enter Your Email" wire:model="email">
							
							@error('email')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</div>
						<div class="form-group">
							<label class="text-muted f-10 mb-1">City</label>
							<input type="text" class="form-control" placeholder="Enter City" wire:model="city">
							
							@error('city')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</div>
{{--						<div class="form-group">--}}
{{--							<label class="text-muted f-10 mb-1">State</label>--}}
{{--							<input type="number" class="form-control" placeholder="Enter State" value="Pun.">--}}
{{--						</div>--}}
						<div class="form-group">
							<label class="text-muted f-10 mb-1">Address</label>
							<textarea class="form-control" placeholder="Enter Address" wire:model="address"></textarea>
							
							@error('address')
							<span class="text-danger">{{$message}}</span>
							@enderror
						</div>
{{--						<div class="form-group">--}}
{{--							<label class="text-muted f-10 mb-1">Life Insurance</label>--}}
{{--							<div class="mt-1">--}}
{{--								<div class="custom-control custom-radio custom-control-inline">--}}
{{--									<input type="radio" id="yes" name="lifeinsurance" class="custom-control-input" checked>--}}
{{--									<label class="custom-control-label small" for="yes">Yes</label>--}}
{{--								</div>--}}
{{--								<div class="custom-control custom-radio custom-control-inline">--}}
{{--									<input type="radio" id="no" name="lifeinsurance" class="custom-control-input">--}}
{{--									<label class="custom-control-label small" for="no">No</label>--}}
{{--								</div>--}}
{{--							</div>--}}
{{--						</div>--}}
						<div class="mb-5">
							<a href="#!" class="btn btn-danger btn-block osahanbus-btn rounded-1" wire:click.prevent="updateProfile">UPDATE PROFILE</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	
</div>
