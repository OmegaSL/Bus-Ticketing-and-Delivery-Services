<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class ForgotPasswordComponent extends Component
{
    public function render()
    {
        return view('livewire.auth.forgot-password-component')->extends('layouts.auth');
    }
}
