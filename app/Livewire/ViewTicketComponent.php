<?php

namespace App\Livewire;

use Livewire\Component;

class ViewTicketComponent extends Component
{
	public $payment_id;
	public $payment;

	public function mount($payment_id)
	{
		$this->payment_id = $payment_id;
		$this->payment = \App\Models\Payment::query()
			->where('payment_id', $this->payment_id)
			->with('booking', 'booking.bus', 'booking.departure_station', 'booking.arrival_station')
			->firstOrFail();
	}

    public function render()
    {
        return view('livewire.view-ticket-component')->extends('layouts.master');
    }
}
