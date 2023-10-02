<?php

namespace App\Livewire;

use Livewire\Component;

class BusSeatsComponent extends Component
{
	public $bus_number;
	public $bus;
	public $selectedSeats = [];
	protected array $queryString = ['selectedSeats'];

	public function mount($bus_number)
	{
		$this->selectedSeats = request()?->query('selectedSeats', $this->selectedSeats);

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
        return view('livewire.bus-seats-component')->extends('layouts.master');
    }

	public function toggleSeat($seatName)
	{
		if (in_array($seatName, $this->selectedSeats, true)) {
			// Seat is already selected, remove it
			$this->selectedSeats = array_diff($this->selectedSeats, [$seatName]);
		} else {
			// Seat is not selected, add it
			$this->selectedSeats[] = $seatName;
		}
//		dd($this->selectedSeats);
	}

	public function makePayment()
	{
		$this->selectedSeats = implode(',', $this->selectedSeats);
//		dd($this->selectedSeats);

		return redirect()->route('make-payment', [$this->bus_number, 'seats' => $this->selectedSeats]);
	}
}
