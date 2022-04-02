<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Code;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;


class GenerateCode extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modalBuyerFormVisible = false;
    public $buyersForm = false;
    public $modelId;
    public $buyerId;

    public $availableDataCode = true;
    public $usedDataCode = true;
    public $productCodeType;
    public $buyerType;
    public $endorsers_id;
    public $singleCodeName;
    public $bundle_name;
    public $code_quantity;
    public $selectedCategory;
    public $selectedSubCategory;
    public $selectedProduct;

    public $buyerFName;
    public $buyerLName;
    public $buyerMName;
    public $buyerAddress;
    public $buyerCP;
    public $buyerEmail;
    public $networkCountData = [];
    
    //Validation Rules
    protected $rules = [
        'endorsers_id' => 'required|exists:users',
        'buyerFName' => 'required',
        'buyerLName' => 'required',
        'buyerMName' => 'required',
        'buyerAddress' => 'required',
        'buyerCP' => 'required',
        'buyerEmail' => 'required',
        'code_quantity' => 'required',
    ];

    protected $messages = [
        'endorsers_id.exists' => "Members ID not Found!",
        'endorsers_id.required' => "Members ID is Required!",
        'buyerFName.required' => "First Name is Required!",
        'buyerLName.required' => 'Last Name is Required!',
        'buyerMName.required' => 'Middle Name is Required!',
        'buyerAddress.required' => 'Address is Required!',
        'buyerCP.required' => 'Cellphone Number is Required!',
        'buyerEmail.required' => 'Email is Required!',
    ];

    public function loadModel(){
        $data = Code::where('id', $this->modelId)->first();
        //Assign The Variable Here
    }

    public function loadBuyerModel(){
        $data = Code::where('id', $this->buyerId)->first();
        
    }
    
    //The Data for the model mapped in this component
    public function modelData(){
        return [
            'category_id' => $this->selectedCategory,
            'sub_category_id' => $this->selectedSubCategory,
            'code' => $this->generateCode($this->selectedCategory),
            'status' => 'Not Used',
            'product_name' => Product::productListOfSubCategory($this->selectedCategory, $this->selectedSubCategory)[$this->selectedProduct],
            'product_id' => $this->selectedProduct,
            'created_at' => now()->toDateTimeString(),
        ];
    }

    public function create(){
        if($this->productCodeType == 'bundle'){
            $this->validateOnly('code_quantity');
        }

        $dataQuantity = $this->code_quantity? $this->code_quantity : 1;
        $data = [];
        for($i = 0; $i < $dataQuantity; $i++){
            array_push($data, $this->modelData());
        }
        
        Code::insert($data);
        $this->modalFormVisible = false;
        $this->resetExcept(['availableDataCode', 'usedDataCode']);
    }
    
    public function read(){
        if($this->usedDataCode && $this->availableDataCode){
            $data = Code::paginate(30);
        }else if($this->usedDataCode == false && $this->availableDataCode == false){
            $data = Code::where('status', '')->paginate(30);
        }else if($this->usedDataCode == true){
            $data = Code::where('status', 'Used')->paginate(30);
        }else if($this->availableDataCode == true){
            $data = Code::where('status', 'Not Used')->paginate(30);
        }

        return $data;
    }

    public function update(){
        $this->validate();
        Code::where('id', $this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete(){
        Code::where('id', $this->modelId)->delete();
        $this->modalConfirmDeleteVisible = false;
    }

    public function createShowModal(){
        $this->resetValidation();
        $this->resetExcept(['availableDataCode', 'usedDataCode']);
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id){
        $this->resetValidation();
        $this->resetExcept(['availableDataCode', 'usedDataCode']);
        $this->modalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    public function deleteShowModal($id){
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function availableCodes(){
        $this->availableDataCode = !$this->availableDataCode;
        $this->render();
    }

    public function usedCodes(){
        $this->usedDataCode = !$this->usedDataCode;
        $this->render();
    }

    public function sendShowModal($id){
        $this->resetValidation();
        $this->resetExcept(['availableDataCode', 'usedDataCode']);
        $this->modalBuyerFormVisible = true;
        $this->buyerId = $id;
        $this->loadBuyerModel();
    }

    public function searchMember(){
        $this->validateOnly('endorsers_id');
        $data = User::where('endorsers_id', $this->endorsers_id)->first();
        $this->buyersForm = true;
        
        // Set The Data get into variable
        // $this->buyerFName = $data->;
        // $this->buyerLName = $data->;
        // $this->buyerMName = $data->;
        // $this->buyerAddress = $data->;
        $this->buyerCP = $data->cp_num;
        $this->buyerEmail = $data->email;
    }

    public function updatedBuyerType($value){
        if($value == ''){
            $this->resetValidation();
            $this->endorsers_id;
            $this->buyersForm = false;
        }

        if($value == 'members'){
            $this->resetValidation();
            $this->buyersForm = false;
        }

        if($value == 'non-members'){
            $this->resetValidation();
            $this->buyersForm = true;
        }
    }

    public function updatedProductCodeType($val){
        $this->reset(['selectedCategory', 'selectedSubCategory', 'selectedProduct']);
    }

    public function submitBuyerInfo(){
        $this->validate();
    }

    public function generateCode($category){
        $MainCategory = ProductCategory::where('id', $category)->first();
        $uniqueCode = $MainCategory->category_initial . now()->format('dmy') . substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
        while(Code::where('code', $uniqueCode)->first()){
            $uniqueCode = "CAT" . now()->format('dmy') . substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
        }

        return $uniqueCode;
    }

    public function networkListData($id){
        $networkList = User::networkList($id);

        $this->networkListDataFormat($networkList);
        
        return $this->networkCountData;
    }

    public function networkListDataFormat($networkList){

        foreach($networkList as $item){
            array_push($this->networkCountData, $item);

            if($item->children->isNotEmpty()){
                $this->networkListDataFormat($item->children);
            }
        }
    }

    public function render()
    {
        return view('livewire.generate-code', [
            'data'=> $this->read()
        ])->layout('layouts.base');
    }
}