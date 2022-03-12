<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StoreComponent extends Component
{
    public function render()
    {
        return view('livewire.store-component')->layout('layouts.base');
    }
}
