<?php

namespace App\Livewire\Delivery;

use Livewire\Component;

class DeliverPackageComponent extends Component
{
	public $stations;

	public $package_name;
	public $package_type;
	public $package_size;
	public $package_description;
	public $package_from;
	public $package_to;
	public $package_sender_name;
	public $package_sender_phone;
	public $package_sender_address;
	public $package_receiver_name;
	public $package_receiver_phone;
	public $package_receiver_address;

	public function mount()
	{
		$this->stations = \App\Models\BusStation::all();
	}

    public function render()
    {
        return view('livewire.delivery.deliver-package-component')->extends('layouts.master');
    }

	public function deliverPackage()
	{
		$this->validate([
			'package_name' => 'required',
			'package_type' => 'required',
			'package_size' => 'required',
			'package_description' => 'required',
			'package_from' => 'required',
			'package_to' => 'required',
			'package_sender_name' => 'required',
			'package_sender_phone' => 'required',
			'package_sender_address' => 'required',
			'package_receiver_name' => 'required',
			'package_receiver_phone' => 'required',
			'package_receiver_address' => 'required',
		]);

		\App\Models\Package::create([
			'user_id' => auth()->user()->id,
			'package_name' => $this->package_name,
			'package_type' => $this->package_type,
			'package_size' => $this->package_size,
			'package_description' => $this->package_description,
			'package_from' => $this->package_from,
			'package_to' => $this->package_to,
			'package_sender_name' => $this->package_sender_name,
			'package_sender_phone' => $this->package_sender_phone,
			'package_sender_address' => $this->package_sender_address,
			'package_receiver_name' => $this->package_receiver_name,
			'package_receiver_phone' => $this->package_receiver_phone,
			'package_receiver_address' => $this->package_receiver_address,
		]);

		return redirect()->route('all-delivery-orders')->with('success', 'Package delivered successfully');
	}
}
