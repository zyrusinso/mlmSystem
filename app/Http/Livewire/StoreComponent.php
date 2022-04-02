<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Store;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class StoreComponent extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;

    public $product_name;
    public $price;
    public $product_code;

    //Validation Rules
    public function rules(){
        return [
            'product_name' => 'required',
            'price' => 'required|numeric',
            'product_code' => 'required'
        ];
    }

    public function loadModel(){
        $data = Store::where('id', $this->modelId)->first();

        //Assign The Variable Here
        $this->product_name = $data->product_name;
        $this->price = $data->price;
        $this->product_code = $data->product_code;
    }
    
    //The Data for the model mapped in this component
    public function modelData(){
        return [
            'product_name' => $this->product_name,
            'price' => $this->price,
            'product_code' => $this->product_code,
        ];
    }

    public function create(){
        $this->validate();
        Store::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }
    
    public function read(){
        return Store::paginate(5);
    }

    public function update(){
        $this->validate();
        Store::where('id', $this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete(){
        Store::where('id', $this->modelId)->delete();
        $this->modalConfirmDeleteVisible = false;
    }

    public function createShowModal(){
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id){
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    public function deleteShowModal($id){
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function render()
    {
        return view('livewire.store-component', [
            'data'=> $this->read()
        ])->layout('layouts.base');
    }
}