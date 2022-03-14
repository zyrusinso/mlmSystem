<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UserRole;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class UserRoles extends Component
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
        $data = UserRole::where('id', $this->modelId)->first();
        //Assign The Variable Here
    }
    
    //The Data for the model mapped in this component
    public function modelData(){
        return [
            
        ];
    }

    public function create(){
        $this->validate();
        UserRole::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }
    
    public function read(){
        return UserRole::paginate(5);
    }

    public function update(){
        $this->validate();
        UserRole::where('id', $this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete(){
        UserRole::where('id', $this->modelId)->delete();
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
        return view('livewire.user-roles', [
            'data'=> $this->read()
        ]);
    }
}