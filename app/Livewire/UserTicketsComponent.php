<?php

namespace App\Livewire;

use Livewire\Component;

class UserTicketsComponent extends Component
{
    public function render()
    {
        return view('livewire.user-tickets-component',[
			'bookings' => \App\Models\Booking::query()
	        				->where('user_id', auth()->user()->id)
	        				->with('bus', 'departure_station', 'arrival_station')
	        				->latest()
	        				->get(),
        ])->extends('layouts.master');
    }
}
