<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Test;

class HomeComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function read(){
        return Test::paginate(3);
    }

    public function mount(){
        $userRole = auth()->user()->role;
        if($userRole == 'user'){
            return redirect(route('transactions'));
        }
    }

    public function render()
    {
        return view('livewire.home-component', [
            'data' => $this->read(),
        ])->layout('layouts.base');
    }
}
