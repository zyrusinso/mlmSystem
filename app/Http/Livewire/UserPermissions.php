<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\UserPermission;
use App\Models\User;

class UserPermissions extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;

    public $role;
    public $routeName;

    //Validation Rules
    public function rules(){
        return [
            'role' => 'required',
            'routeName' => 'required',
        ];
    }

    public function loadModel(){
        $data = UserPermission::where('id', $this->modelId)->first();
        
        //Assign The Variable Here
        $this->role = $data->role;
        $this->routeName = $data->route_url;
    }
    
    //The Data for the model mapped in this component
    public function modelData(){
        return [
            'role' => $this->role,
            'route_url' => $this->routeName, 
            'route_name' => User::routeNameList()[$this->routeName], 
        ];
    }

    public function create(){
        $this->mount();
        $this->render();
        $this->validate();
        UserPermission::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }
    
    public function read(){
        return UserPermission::orderBy('role')->paginate(15);
    }

    public function update(){
        $this->mount();
        $this->render();
        $this->validate();
        UserPermission::where('id', $this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete(){
        $this->mount();
        $this->render();
        UserPermission::where('id', $this->modelId)->delete();
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
        return view('livewire.user-permissions', [
            'data'=> $this->read()
        ])->layout('layouts.base');
    }
}