<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class HomeComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function read(){
        return User::where('referred_by', auth()->user()->endorsers_id)->paginate(10);
    }

    public function mount(){
        $userRole = auth()->user()->role;
        if($userRole == 'user'){
            return redirect(route('transactions'));
        }
    }

    
    // Product Endorsers
    public function PEdata($id){
        $data = User::where('referred_by', $id)->get();
        return $data;
    }

    // Business Endorsers
    public function BEdata($id){
        $data = User::where('referred_by', $id)->get();
        return $data;
    }

    public function render()
    {
        return view('livewire.home-component', [
            'data' => $this->read(),
        ])->layout('layouts.base');
    }
}
