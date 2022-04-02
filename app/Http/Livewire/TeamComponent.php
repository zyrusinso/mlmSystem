<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Vinkla\Hashids\Facades\Hashids;

class TeamComponent extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;

    //Validation Rules
    public function rules(){
        return [
            
        ];
    }

    public function loadModel(){
        $data = User::where('id', $this->modelId)->first();
        //Assign The Variable Here
    }
    
    //The Data for the model mapped in this component
    public function modelData(){
        return [
            
        ];
    }

    public function create(){
        $this->validate();
        User::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }
    
    public function read(){
        return User::where('referred_by', auth()->user()->endorsers_id)->paginate(5);
    }

    public function update(){
        $this->validate();
        User::where('id', $this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete(){
        User::where('id', $this->modelId)->delete();
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

    public function TeamView($id){
        $encryptedId = Hashids::encode($id);
        $user = User::where('id', $id)->first();
        $userLvl = Hashids::encode($user->level);
        return redirect(route('team.index', ['id' => $encryptedId, 'lvl' => $userLvl]));
    }

    public function render()
    {
        return view('livewire.team-component', [
            'data'=> $this->read()
        ])->layout('layouts.base');
    }
}