<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\Code;
use App\Models\User;
use App\Models\Product;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ActivateUser extends Component
{
    public $ModalFormVisible = false;

    public $code;
    
    protected $listeners = ['show' => 'createShowModal'];

    //Validation Rules
    public function rules(){
        return [
            'code' => 'required|exists:codes',
        ];
    }
    
    public function createUniqueTransactionCode(){
        $UniqueTransactionCode = mt_rand(10000000, 99999999);
        while(Transaction::where('transaction_id', $UniqueTransactionCode)->first()){
            $UniqueTransactionCode = "WLC".now()->format('y')."-".mt_rand(100000, 999999);
        }

        return $UniqueTransactionCode;
    }

    //The Data for the model mapped in this component
    public function modelData(){
        return [
            'code' => $this->code,
        ];
    }

    public function userActivateModelData(){
        return [
            'role' => 'product-endorsers'
        ];
    }

    public function userPurchasedModelData($priceOfCode = 0){
        return [
            'tpp' => auth()->user()->tpp + $priceOfCode,
        ];
    }

    public function transactionModelData($productSelected){
        return [
            'user_id' => auth()->user()->id,
            'name' => auth()->user()->full_name,
            'amount' => $productSelected->srp,
            'transaction_id' => $this->createUniqueTransactionCode(),
            'product_id' => $productSelected->id,
            'product_code' => $this->code
        ];
    }

    public function create(){
        $this->validate();
        $codeSelected = Code::where('code', $this->code)->first();
        $productSelected = Product::where('id', $codeSelected->product_id)->first();
        $userTotalPurchaseWithCode = auth()->user()->tpp + $productSelected->srp;

        try {
            DB::beginTransaction();

            if($userTotalPurchaseWithCode >= 1500){
                User::where('id', auth()->user()->id)->update($this->userActivateModelData());
            }else{
                User::where('id', auth()->user()->id)->update($this->userPurchasedModelData($productSelected->srp));
            }
            Transaction::create($this->transactionModelData($productSelected));
        } catch (Throwable $ex) {

            DB::rollBack();
            Log::critical($ex);
            return response()->json([
                'success' => false,
                'message' => 'System Failed to create new account! please contact the admin to fix this problem!', //Activation failed.
            ], 500);
        }
        DB::commit();

        return redirect(route(User::userRoleRedirect(auth()->user()->role)));
    }

    public function createShowModal(){
        $this->resetValidation();
        $this->reset();
        $this->ModalFormVisible = true;
    }

    public function render()
    {
        return view('livewire.activate-user');
    }
}
