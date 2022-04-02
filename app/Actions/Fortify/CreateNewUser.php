<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'full_name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cp_num' => ['required', 'numeric'],
            // 'activation_code' => ['required', 'numeric'],
            'endorsers_id' => ['required', 'string', 'exists:users,endorsers_id'],
            // 'password' => $this->passwordRules(),
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], ['exists' => "The Endorsers ID is Invalid"])->validate();

        $UniqueEndorsersID = "WLC".now()->format('y')."-".mt_rand(100000, 999999);
        while(User::where('endorsers_id', $UniqueEndorsersID)->first()){
            $UniqueEndorsersID = "WLC".now()->format('y')."-".mt_rand(100000, 999999);
        }

        $registrationEndorsers = User::where('endorsers', $input['endorsers_id'])->first();
        $endorsersLevel = $registrationEndorsers->level;

        return User::create([
            'full_name' => $input['full_name'],
            'email' => $input['email'],
            'password' => Hash::make("wlc_pass#1234"),
            'cp_num' => $input['cp_num'],
            // 'activation_code' => $input['activation_code'],
            'endorsers_id' => $UniqueEndorsersID,
            'referred_by' => $input['endorsers_id'],
            'level' => $endorsersLevel++,
        ]);
    }
}
