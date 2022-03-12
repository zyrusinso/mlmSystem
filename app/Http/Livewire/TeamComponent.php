<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Test;


class TeamComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function read(){
        return Test::paginate(3);
    }

    public function render()
    {
        return view('livewire.team-component', [
            'data' => $this->read(),
        ])->layout('layouts.base');
    }
}
