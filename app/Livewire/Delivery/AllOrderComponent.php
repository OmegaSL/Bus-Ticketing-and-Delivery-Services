<?php

namespace App\Livewire\Delivery;

use Livewire\Component;

class AllOrderComponent extends Component
{
    public function render()
    {
        return view('livewire.delivery.all-order-component',[
			'packages' => \App\Models\Package::where('user_id', auth()->user()->id)->get()
        ])->extends('layouts.master');
    }
}
