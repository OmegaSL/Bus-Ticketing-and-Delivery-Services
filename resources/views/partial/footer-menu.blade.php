<div class="fixed-bottom p-3">
	<div class="footer-menu row m-0 bg-danger shadow rounded-2">
		<div class="col-3 p-0 text-center">
			<a  wire:navigate href="{{ route('home') }}" class="home text-white {{ request()->routeIs('home') ? 'active' : ''}}">
				<span class="icofont-ui-home h5"></span>
				<p class="mb-0 small">Home</p>
			</a>
		</div>
		<div class="col-3 p-0 text-center">
			<a wire:navigate href="{{ route('my-tickets') }}" class="home text-white {{ request()->routeIs('my-tickets') ? 'active' : ''}}">
				<span class="icofont-ticket h5"></span>
				<p class="mb-0 small">My Tickets</p>
			</a>
		</div>
		<div class="col-3 p-0 text-center">
			<a href="#!" class="home text-white">
				<span class="icofont-fast-delivery h5"></span>
{{--				<small class="osahan-n">4</small>--}}
				<p class="mb-0 small">Deliver Package</p>
			</a>
		</div>
		<div class="col-3 p-0 text-center">
			<a wire:navigate href="{{ route('profile') }}" class="home text-white {{ request()->routeIs('profile') ? 'active' : ''}}">
				<span class="icofont-user h5"></span>
				<p class="mb-0 small">Account</p>
			</a>
		</div>
	</div>
</div>