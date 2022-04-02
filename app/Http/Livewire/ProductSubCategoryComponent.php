<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductSubCategory;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class ProductSubCategoryComponent extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;

    public $sub_cat_name;
    public $main_category;

    //Validation Rules
    public function rules(){
        return [
            'sub_cat_name' => 'required|min:3',
            'main_category' => 'required'
        ];
    }

    public function loadModel(){
        $data = ProductSubCategory::where('id', $this->modelId)->first();

        //Assign The Variable Here
        $this->sub_cat_name = $data->sub_cat_name;
        $this->main_category = $data->category_id;
    }
    
    //The Data for the model mapped in this component
    public function modelData(){
        return [
            'sub_cat_name' => $this->sub_cat_name,
            'category_id' => $this->main_category,
        ];
    }

    public function create(){
        $this->validate();
        ProductSubCategory::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }
    
    public function read(){
        return ProductSubCategory::paginate(5);
    }

    public function update(){
        $this->validate();
        ProductSubCategory::where('id', $this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete(){
        ProductSubCategory::where('id', $this->modelId)->delete();
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
        return view('livewire.product-sub-category-component', [
            'data'=> $this->read()
        ])->layout('layouts.base');
    }
}