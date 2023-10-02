<?php

namespace App\Livewire\Auth;

use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class VerificationComponent extends Component
{
	public $email;
	public $otp_code_input_1;
	public $otp_code_input_2;
	public $otp_code_input_3;
	public $otp_code_input_4;
	public $otp_code;

	public function mount()
	{
		if (!auth()->check()) {
			return redirect()->route('register');
		}

		if (auth()->check() && auth()->user()->email_verified_at) {
			return redirect()->route('home');
		}

		$this->email = auth()->user()->email;
	}

    public function render()
    {
        return view('livewire.auth.verification-component')->extends('layouts.auth');
    }

	public function verify()
	{
		$validator = Validator::make(
			[
				'email' => $this->email,
				'otp_code' => $this->otp_code_input_1 . $this->otp_code_input_2 . $this->otp_code_input_3 . $this->otp_code_input_4,
			],
			[
				'email' => 'required|email|exists:users,email',
				'otp_code' => 'required|numeric|digits:4',
			]
		);

		if ($validator->fails()) {
			toastr()->error($validator->messages()->first());
			return;
		}

		// combine the six input digits into a single string
		$this->otp_code = $this->otp_code_input_1 . $this->otp_code_input_2 . $this->otp_code_input_3 . $this->otp_code_input_4;
		// dd($this->otp_code);

		$user = \App\Models\User::where('email', $this->email)->where('otp_code', $this->otp_code)->first();

		if (!$user) {
			toastr()->error('Invalid OTP code');
			return;
		}

		$user->email_verified_at = now();
		$user->otp_code = null;
		$user->save();

		toastr()->success('Account verified successfully');
		return redirect()->route('home');
	}

	/**
	 * @throws Exception
	 */
	public function resendOTPCode()
	{
		// limit resend otp_code every 60 seconds
		if (auth()->user()->otp_code && now()->diffInSeconds(auth()->user()->updated_at) < 60) {
			toastr()->error('Please wait for 60 seconds before resending OTP code');
			return;
		}

		// send otp_code to user email
		$otp_code = random_int(1000, 9999);
		auth()->user()->update([
			'otp_code' => $otp_code
		]);

		$data = [
			'name' => auth()->user()->name,
			'email' => auth()->user()->email,
			'otp_code' => $otp_code,
		];

		Mail::send('emails.register-mail', $data, static function ($message) {
			$message->from(config('mail.from.address'), config('mail.from.name'));
			$message->to(auth()->user()->email, auth()->user()->name);
			$message->subject('Verification OTP Code');
		});

		toastr()->success('OTP code sent successfully');
		return redirect()->back();
	}
}
