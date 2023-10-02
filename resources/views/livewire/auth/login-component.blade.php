<div>
	
	<div class="osahan-signup">
		<div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
			<h5 class="font-weight-normal mb-0 text-white">
				<a class="text-danger mr-3" wire:navigate.hover href="{{ route('getting-started') }}"><i class="icofont-rounded-left"></i></a>
				Sign in to your account
			</h5>
			<div class="ml-auto d-flex align-items-center">
				<a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
			</div>
		</div>
		<div class="px-3 pt-3 pb-5">
			<form wire:submit.prevent="submitLogin">
				<div class="form-group">
					<label class="text-muted f-10 mb-1">Mobile Number</label>
					<input type="number" class="form-control" placeholder="Enter Mobile Number" wire:model.blur="login">
					
					@error('login')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
{{--				<div class="form-group">--}}
{{--					<label class="text-muted f-10 mb-1">Your Email</label>--}}
{{--					<input type="email" class="form-control" placeholder="Enter Your Email" value="example@mail.com">--}}
{{--				</div>--}}
				<div class="form-group">
					<label class="text-muted f-10 mb-1">Password</label>
					<input type="password" class="form-control" placeholder="Enter Your Password" wire:model.blur="password">
					
					@error('password')
						<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				<div class="text-right mb-3">
					<a wire:navigate.hover href="{{ route('forgot-password') }}" class="text-muted small">Forgot your password?</a>
				</div>
				
				<button type="submit" class="btn btn-danger btn-block osahanbus-btn mb-4 rounded-1">SIGN IN</button>
{{--				<div wire:loading>--}}
{{--					Logging...--}}
{{--				</div>--}}
			</form>
{{--			<div class="sign-or d-flex align-items-center justify-content-center mb-4">--}}
{{--				<hr class="mr-4">--}}
{{--				<p class="text-muted text-center py-2 m-0">OR</p>--}}
{{--				<hr class="ml-4">--}}
{{--			</div>--}}
{{--			<a href="{{ route('verification') }}" class="btn btn-block rounded-1 google-btn osahanbus-social">--}}
{{--				<i class="icofont-google-plus"></i> LOGIN WITH GOOGLE--}}
{{--			</a>--}}
{{--			<a href="{{ route('verification') }}" class="my-3 btn btn-block rounded-1 fb-btn osahanbus-social">--}}
{{--				<i class="icofont-facebook"></i> LOGIN WITH FACEBOOK--}}
{{--			</a>--}}
			<div class="osahan-signin text-center p-1">
				<p class="m-0">Not a member ? <a wire:navigate.hover href="{{ route('register') }}" class="text-danger ml-2">Sign Up</a></p>
			</div>
		</div>
	</div>
	
</div>
