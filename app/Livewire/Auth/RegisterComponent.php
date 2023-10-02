<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class RegisterComponent extends Component
{
	public $first_name;
	public $last_name;
	public $email;
	public $password;
	public $confirmation_password;
	public $phone_number;

	public function mount()
	{
		if (auth()->check()){
			return redirect('home');
		}
	}

	/**
	 * @throws Exception
	 */
	public function submitRegister()
	{
		$validated = $this->validate([
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'email' => 'required|min:3',
			'phone_number' => 'required|min:3',
			'password' => 'required|min:3',
			'confirmation_password' => 'required|min:3|same:password',
		]);

		$otp_code = random_int(1000, 9999);

		$user = User::create([
			'name' => $this->first_name,
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'email' => $this->email,
			'phone_number' => $this->phone_number,
			'password'  => Hash::make($this->password),
			'otp_code' => $otp_code,
		]);

		$data = [
			'email' => 	$user->email,
			'phone_number' => $user->phone_number,
			'otp_code' => $otp_code,
		];

		Mail::send('emails.register-mail', $data, static function ($message) use ($user) {
			$message->from(config('mail.from.address'), config('mail.from.name'));
			$message->to($user->email, $user->first_name . ' ' . $user->last_name);
			$message->subject('Verification OTP Code');
		});

		auth()->login($user);

		return redirect()->route('verification')->with('info', 'Check your mail for the verification code.');
	}

    public function render()
    {
        return view('livewire.auth.register-component')->extends('layouts.auth');
    }
}
