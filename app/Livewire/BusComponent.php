<?php

namespace App\Livewire;

use Livewire\Component;

class BusComponent extends Component
{
	public $bus_number;
	public $bus;

	public function mount($bus_number)
	{
		$this->bus_number = $bus_number;

		$this->bus = \App\Models\Bus::query()
			->with('bus_histories', function ($query) {
				$query->latest();
			})
			->where('bus_number', $this->bus_number)
			->firstOrFail();
	}

    public function render()
    {
        return view('livewire.bus-component')->extends('layouts.master');
    }

	public function bookSeat($bus_number)
	{
//		return redirect()->route('bus-seats', ['bus_number' => $bus_number]);
		return $this->redirect(route('bus-seats', ['bus_number' => $bus_number]), true);
	}
}
