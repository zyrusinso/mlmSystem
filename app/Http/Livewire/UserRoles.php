<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\UserRole;
use App\Models\User;

class UserRoles extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;

    public $role;
    public $name;
    public $redirectUrl;

    //Validation Rules
    public function rules(){
        return [
            'role' => 'required|string|min:3',
            'name' => 'required|string|'
        ];
    }

    public function loadModel(){
        $data = UserRole::where('id', $this->modelId)->first();

        //Assign The Variable Here
        $this->role = $data->role;
        $this->name = $data->name;
        $this->redirectUrl = $data->redirect_url;
    }
    
    //The Data for the model mapped in this component
    public function modelData(){
        return [
            'role' => Str::kebab($this->role),
            'name' => $this->name,
            'redirect_url' => $this->redirectUrl,
            'redirect_url_name' => User::routeNameList()[$this->redirectUrl],
        ];
    }

    public function create(){
        $this->validate();
        UserRole::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }
    
    public function read(){
        return UserRole::paginate(15);
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
        ])->layout('layouts.base');
    }
}