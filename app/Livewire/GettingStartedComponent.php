<?php

namespace App\Livewire;

use Livewire\Component;

class GettingStartedComponent extends Component
{
    public function mount()
    {
        if (auth()->check()) {
            return redirect('home');
        }
    }

    public function render()
    {
        return view('livewire.getting-started-component')->extends('layouts.partial');
    }
}
