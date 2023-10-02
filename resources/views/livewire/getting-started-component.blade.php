<div>
	
	<div class="py-4 d-flex align-items-center justify-content-center">
		<div class="osahan-started pt-2 text-center">
			<img src="{{ asset('assets/img/sign-in-pana.svg') }}" class="img-fluid mb-2 col-9 mx-auto">
			<div class="head py-4 px-4 text-center">
				<h5 class="font-weight-bold mb-4">Start by creating an account.</h5>
				<p class="text-muted">I'm an early bird, and I'm night owl, so I'm<br>wise and I have worms.</p>
			</div>
			<div class="fixed-bottom p-4">
				<a wire:navigate.hover href="{{ route('register') }}" class="btn btn-block btn-danger mb-3 osahanbus-btn">CREATE AN ACCOUNT</a>
				<a wire:navigate.hover href="{{ route('login') }}" class="btn btn-block btn-light osahanbus-btn">SIGN IN</a>
			</div>
		</div>
	</div>
	
	{{--	@include('partial.sidebar')--}}
	
</div>
