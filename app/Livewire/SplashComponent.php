<?php

namespace App\Livewire;

use Livewire\Component;

class SplashComponent extends Component
{
    public function render()
    {
        return view('livewire.splash-component')->extends('layouts.partial');
    }
}
