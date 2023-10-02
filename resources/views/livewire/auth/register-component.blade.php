<div>
	
	<div class="osahan-signup">
		<div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
			<h5 class="font-weight-normal mb-0 text-white">
				<a class="text-danger mr-3" wire:navigate.hover href="{{ route('getting-started') }}"><i class="icofont-rounded-left"></i></a>
				Create an account
			</h5>
			<div class="ml-auto d-flex align-items-center">
				<a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
			</div>
		</div>
		<div class="p-3">
			<form wire:submit.prevent="submitRegister">
				<div class="form-group">
					<label class="text-muted f-10 mb-1">Your First Name</label>
					<input type="text" class="form-control" placeholder="Enter Your First Name" wire:model.blur="first_name">
					
					@error('first_name')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label class="text-muted f-10 mb-1">Your Last Name</label>
					<input type="text" class="form-control" placeholder="Enter Your Last Name" wire:model.blur="last_name">
					
					@error('last_name')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label class="text-muted f-10 mb-1">Your Email</label>
					<input type="email" class="form-control" placeholder="Enter Your Email" wire:model.blur="email">
					
					@error('email')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label class="text-muted f-10 mb-1">Your Phone Number</label>
					<input type="number" class="form-control" placeholder="Enter Your Phone Number" wire:model.blur="phone_number">
					
					@error('phone_number')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label class="text-muted f-10 mb-1">Password</label>
					<input type="password" class="form-control" placeholder="Enter Your Password" wire:model.blur="password">
					
					@error('password')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label class="text-muted f-10 mb-1">Confirm Password</label>
					<input type="password" class="form-control" placeholder="Enter Your Confirm Password" wire:model.blur="confirmation_password">
					
					@error('confirmation_password')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				<button type="submit" class="btn btn-danger btn-block osahanbus-btn mb-3 rounded-1 mt-4">CREATE AN ACCOUNT</button>
				<p class="text-muted text-center small">By signing up you agree to our Privacy Policy and Terms.</p>
			</form>
{{--			<div class="sign-or d-flex align-items-center justify-content-center mb-4">--}}
{{--				<hr class="mr-4">--}}
{{--				<p class="text-muted text-center py-2 m-0">OR</p>--}}
{{--				<hr class="ml-4">--}}
{{--			</div>--}}
{{--			<a href="verification.html" class="btn btn-block rounded-1 google-btn osahanbus-social">--}}
{{--				<i class="icofont-google-plus"></i> LOGIN WITH GOOGLE--}}
{{--			</a>--}}
{{--			<a href="verification.html" class="my-3 btn btn-block rounded-1 fb-btn osahanbus-social">--}}
{{--				<i class="icofont-facebook"></i> LOGIN WITH FACEBOOK--}}
{{--			</a>--}}
		</div>
	</div>

</div>
