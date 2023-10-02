<?php

namespace App\Livewire;

use Livewire\Component;

class LandingComponent extends Component
{
    public function render()
    {
        return view('livewire.landing-component')->extends('layouts.partial');
    }
}
