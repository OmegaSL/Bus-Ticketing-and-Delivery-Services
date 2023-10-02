<div>
	
	<div class="osahan-verification">
		<div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
			<h5 class="font-weight-normal mb-0 text-white">
				<a class="text-danger mr-3" wire:navigate.hover href="{{ route('register') }}"><i class="icofont-rounded-left"></i></a>
				Enter verification code
			</h5>
			<div class="ml-auto d-flex align-items-center">
				<a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
			</div>
		</div>
		<div class="osahan-form px-3 py-5 text-center mb-5">
			<form wire:submit.prevent='verify'>
				<div class="input-group">
					<input type="email" class="form-control" wire:model='email' disabled readonly required
					       placeholder="Your Email">
				</div>
				<br>
				<div class="row my-5 px-3 pb-2">
					<div class="col px-1">
						<input type="number" class="form-control opt border-0 form-control-lg text-center pb-0 px-0"
						       wire:model.blur='otp_code_input_1' maxlength="1" min="0" autofocus>
					</div>
					<div class="col px-1">
						<input type="number" class="form-control opt border-0 form-control-lg text-center pb-0 px-0"
						       wire:model.blur='otp_code_input_2' maxlength="1" min="0">
					</div>
					<div class="col px-1">
						<input type="number" class="form-control opt border-0 form-control-lg text-center pb-0 px-0"
						       wire:model.blur='otp_code_input_3' maxlength="1" min="0">
					</div>
					<div class="col px-1">
						<input type="number" class="form-control opt border-0 form-control-lg text-center pb-0 px-0"
						       wire:model.blur='otp_code_input_4' maxlength="1" min="0">
					</div>
				</div>
				<button type="submit" name="submit_button" class="btn btn-danger btn-block osahanbus-btn mb-4">VERIFICATION</button>
				
				<div wire:poll.visible>
					@if (now()->diffInSeconds(auth()->user()->updated_at) > 60)
						<p class="text-muted">
							Didn't receive it?
							<a href="#" wire:loading.remove wire:click.prevent='resendOTPCode' class="ml-2 text-danger">Resend</a>
							<a href="#!" class="btn-link" wire:loading wire:target='resendOTPCode' style="pointer-events: none; cursor: default;">
								Resending OTP Code...
							</a>
						</p>
					@else
						<p class="text-muted">
							Please check your email for the code or wait for 60 seconds to resend the code.
							@php
								$remainingTime = 60 - now()->diffInSeconds(auth()->user()->updated_at);
	
								if ($remainingTime < 0) {
									$remainingTime = 0;
								}
	
								echo $remainingTime;
							@endphp
						</p>
					@endif
				</div>
			</form>
		</div>
	</div>

</div>

@section('scripts')
@endsection

