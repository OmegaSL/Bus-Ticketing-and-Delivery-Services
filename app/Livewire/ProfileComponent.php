<?php

namespace App\Livewire;

use Livewire\Component;

class ProfileComponent extends Component
{
	public $user;
	public $name;
	public $first_name;
	public $last_name;
	public $email;
	public $phone_number;
	public $city;
	public $address;

	public function mount()
	{
		$this->user = auth()->user();
		$this->name = $this->user->name;
		$this->first_name = $this->user->first_name;
		$this->last_name = $this->user->last_name;
		$this->email = $this->user->email;
		$this->phone_number = $this->user->phone_number;
		$this->city = $this->user->city;
		$this->address = $this->user->address;
//		dd(\App\Models\User::where('id', auth()->id())->first());
	}

	public function updateProfile()
	{
		$this->validate([
			'name' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
			'phone_number' => 'required',
			'city' => 'required',
			'address' => 'required',
		]);

		$user = \App\Models\User::where('id', auth()->id())->first();
		$user->name = $this->name;
		$user->first_name = $this->first_name;
		$user->last_name = $this->last_name;
		$user->email = $this->email;
		$user->phone_number = $this->phone_number;
		$user->city = $this->city;
		$user->address = $this->address;
		$user->save();

		session()->flash('success', 'Profile updated successfully!');
		return redirect()->route('profile')->with('success', 'Profile updated successfully!');
	}

    public function render()
    {
        return view('livewire.profile-component')->extends('layouts.master');
    }
}
