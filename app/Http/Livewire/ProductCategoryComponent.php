<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class ProductCategoryComponent extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;

    public $category_name;
    public $category_initial;

    //Validation Rules
    public function rules(){
        return [
            'category_name' => 'required|min:3',
            'category_initial' => 'required|min:1'
        ];
    }

    public function loadModel(){
        $data = ProductCategory::where('id', $this->modelId)->first();

        //Assign The Variable Here
        $this->category_name = $data->category_name;
        $this->category_initial = $data->category_initial;
    }
    
    //The Data for the model mapped in this component
    public function modelData(){
        return [
            'category_name' => $this->category_name,
            'category_initial' => $this->category_initial
        ];
    }

    public function create(){
        $this->validate();
        ProductCategory::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }
    
    public function read(){
        return ProductCategory::paginate(5);
    }

    public function update(){
        $this->validate();
        ProductCategory::where('id', $this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete(){
        ProductCategory::where('id', $this->modelId)->delete();
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
        return view('livewire.product-category-component', [
            'data'=> $this->read()
        ])->layout('layouts.base');
    }
}