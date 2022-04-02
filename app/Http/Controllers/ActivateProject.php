<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
                'email_verified_at' => now()->toDateTimeString(),
                'password' => Hash::make('wlc_superadmin#1234'),
                'level' => 0,
            ]);
            UserRole::create([
                'role' => 'user', 
                'name'=> 'User', 
                'redirect_url' => 
                'transactions', 
                'redirect_url_name' => 
                'Transactions'
            ]);

            return "Success";
        }else{
            return "Project is already Activated";
        }
    }
}
