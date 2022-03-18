<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChangePassword extends Component
{
    public function render()
    {
        return view('livewire.change-password')->layout('layouts.guest');
    }
}
