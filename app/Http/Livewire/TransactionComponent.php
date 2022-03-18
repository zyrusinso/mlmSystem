<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TransactionComponent extends Component
{
    use Withpagination;

    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;

    public $name;
    public $amount;
    public $product_id;

    //Validation Rules
    public function rules(){
        return [
            'name' => 'required',
            'amount' => ['required', 'integer'],
            'product_id' => 'required|integer'
        ];
    }

    public function loadModel(){
        $data = Transaction::where('id', $this->modelId)->first();

        //Assign The Variable Here
        $this->name = $data->name;
        $this->amount = $data->amount;
        $this->product_id = $data->product_id;
    }

    //The Data for the model mapped in this component
    public function modelData(){
        return [
            'user_id' => auth()->user()->endorsers_id,
            'name' => $this->name,
            'amount' => $this->amount,
            'product_id' => $this->product_id,
            'transaction_id' => $this->numberBetween(100000000),
        ];
    }

    public function create(){
        $this->validate();
        Transaction::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    public function read(){
        return Transaction::where('user_id', auth()->user()->endorsers_id)->paginate(5);
    }

    public function update(){
        $this->validate();
        Transaction::where('id', $this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete(){
        Transaction::where('id', $this->modelId)->delete();
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

    public function numberBetween(int $min = 0, int $max = 2147483647): int
    {
        $int1 = $min < $max ? $min : $max;
        $int2 = $min < $max ? $max : $min;

        return mt_rand($int1, $int2);
    }

    public function render()
    {
        return view('livewire.transaction-component', [
            'data' => $this->read(),
        ])->layout('layouts.base');
    }
}
