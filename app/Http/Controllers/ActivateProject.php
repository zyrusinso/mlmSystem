<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ActivateProject extends Controller
{
    public function activate(){
        if(User::all()->count() < 1){
            User::create([
                'referred_by' => 'Creator',
                'endorsers_id' => 'WLC22-170322',
                'role' => 'super_admin',
                'full_name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'activation_code' => 'WLC-Creator',
                'email_verified_at' => '2022-03-17 12:00:04',
                'password' => Hash::make('wlc_superadmin#1234'),
            ]);
        }else{
            return "Project is already Activated";
        }
    }
}
