<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use Vinkla\Hashids\Facades\Hashids;
use Livewire\WithPagination;
use App\Models\User;

class TeamViewComponent extends Component
{
    use WithPagination;

    public $user;
    public $data;
    public $TitleHeader;
    
    public function read(){
        
    }

    public function mount($id, Request $request){
        session()->forget('showLimit');
        $user = User::where('id', Hashids::decode($id))->first();
        $userLevel = Hashids::decode($request->get('lvl'));

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
        $user = User::where('id', $id)->first();
        $userLvl = Hashids::encode($user->level);

        if($user->level > auth()->user()->level+5){
            session()->flash('showLimit', 'You cant view more');
            return;
        }
        
        return redirect(route('team.index', ['id' => $encryptedId, 'lvl' => $userLvl]));
    }

    public function render()
    {
        return view('livewire.team-view-component')->layout('layouts.base');
    }
}
