<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class LoginComponent extends Component
{
	public $login;
	public $password;

	public function mount()
	{
		if (auth()->check()){
			return redirect('home');
		}
	}

    public function render()
    {
        return view('livewire.auth.login-component')->extends('layouts.auth');
    }

	public function submitLogin()
	{
		$validated = $this->validate([
			'login' => 'required|min:3',
			'password' => 'required|min:3',
		]);

		$field = filter_var($this->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

		// Prepare credentials for authentication
		$credentials = [
			$field => $this->login,
			'password' => $this->password,
		];

		// Attempt user authentication
		if (!auth()->attempt($credentials)) {
			toastr()->error('Oops! Invalid credentials!', 'Oops!');
			return redirect()->back();
		}

		return redirect('home')->with('success', 'Congrats! Login was successful');
	}
}
