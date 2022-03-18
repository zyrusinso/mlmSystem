<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\User;

class TeamViewComponent extends Component
{
    public $user;
    public $data;
    public $TitleHeader;
    
    public function read(){
        
    }

    public function mount($id){
        $user = User::where('id', Hashids::decode($id))->first();
        
        if($user){
            $data = User::where('referred_by', $user->endorsers_id)->get();

            $this->TitleHeader = $user->full_name;
            $this->user = $user;
            if($data){
                $this->data = $data;
            }
        }else{
            abort(403, "This team is not exist!");
        }
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
        return redirect(route('team.index', $encryptedId));
    }

    public function render()
    {
        return view('livewire.team-view-component')->layout('layouts.base');
    }
}
