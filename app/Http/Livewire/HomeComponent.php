<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class HomeComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $networkCountData = [];

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
        $data = User::where('referred_by', $id)
                    ->where('role', 'product-endorsers')->get();
        return $data;
    }

    // Business Endorsers
    public function BEdata($id){
        $data = User::where('referred_by', $id)
                    ->where('role', 'business-endorsers')->get();
        return $data;
    }

    // Product Users
    public function PUdata($id){
        $data = User::where('referred_by', $id)
                    ->where('role', 'user')->get();

        return $data;
    }

    // Network List Data
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
        return view('livewire.home-component', [
            'data' => $this->read(),
        ])->layout('layouts.base');
    }
}
