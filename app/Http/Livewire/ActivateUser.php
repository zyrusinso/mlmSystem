<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ActivateUser extends Component
{
    public $ModalFormVisible = false;

    public $product_code;
    
    protected $listeners = ['show' => 'createShowModal'];

    //The Data for the model mapped in this component
    // public function modelData(){
    //     return [
    //         'name' => $this->name,
    //     ];
    // }

    public function create(){
        // $this->validate();
        // Transaction::create($this->modelData());
        // $this->modalFormVisible = false;
        // $this->reset();
    }

    public function createShowModal(){
        $this->ModalFormVisible = true;
    }

    public function render()
    {
        return view('livewire.activate-user');
    }
}
