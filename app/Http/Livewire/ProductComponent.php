<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class ProductComponent extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $subCategoryForm = false;
    public $productForm = false;

    public $product_name;
    public $price;
    public $product_code;
    public $srp;
    public $packaging;
    public $description;
    public $selectedCategory;
    public $selectedSubCategory;
    public $packageType;

    //Validation Rules
    public function rules(){
        return [
            'product_name' => 'required|string',
            'price' => 'required|numeric',
            // 'product_code' => 'required',
            'srp' => 'required',
            'packaging' => 'required',
            'packageType' => 'required',
            'description' => 'required',
        ];
    }
 
    public function loadModel(){
        $data = Product::where('id', $this->modelId)->first();

        //Assign The Variable Here
        $this->selectedCategory = $data->category_id;
        $this->selectedSubCategory = $data->sub_category_id;
        $this->product_name = $data->product_name;
        $this->price = $data->raw_price;
        $this->product_code = $data->product_code;
        $this->srp = $data->srp;
        $this->packaging = $data->packaging;
        $this->packageType = $data->packaging_type;
        $this->description = $data->description;
    }
    
    //The Data for the model mapped in this component
    public function modelData(){
        return [
            'category_id' => $this->selectedCategory,
            'sub_category_id' => $this->selectedSubCategory,
            'product_name' => $this->product_name,
            'raw_price' => $this->price,
            // 'product_code' => $this->product_code,
            'srp' => $this->srp,
            'packaging' => $this->packaging,
            'packaging_type' => $this->packageType,
            'description' => $this->description,
        ];
    }

    public function create(){
        $this->validateMultiple(['product_name', 'price', 'product_code', 'srp', 'packaging', 'packageType', 'description']);
        Product::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }
    
    public function read(){
        return Product::paginate(30);
    }

    public function update(){
        $this->validate();
        Product::where('id', $this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete(){
        Product::where('id', $this->modelId)->delete();
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
        $this->subCategoryForm = true;
        $this->productForm = true;
    }

    public function deleteShowModal($id){
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function updatedSelectedCategory($val){
        if($val == ''){
            $this->resetValidation();
            $this->subCategoryForm = false;
        }
        if($val){
            $this->subCategoryForm = true;
        }
    }

    public function updatedSelectedSubCategory($val){
        if($val == ''){
            $this->productForm = false;
        }
        if($val){
            $this->productForm = true;
        }
    }

    function validateMultiple($fields){
        $validated = [];
        foreach($fields as $field){
            $validatedData = $this->validateOnly($field);
            $validated[ key($validatedData) ] = current($validatedData);
        }
        return $validated;
    }

    public function render()
    {
        return view('livewire.product-component', [
            'data'=> $this->read()
        ])->layout('layouts.base');
    }
}