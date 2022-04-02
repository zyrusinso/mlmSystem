<?php

if(!function_exists('defaultUserAccessRole')){
    function defaultUserAccessRole(){
        return [
            'user' => [
                'transactions',
                'store'
            ],
            'super_admin' => [
                'dashboard',
                'team',
                'transactions',
                'user-permissions',
                'rewards',
                'store',
                'roles',
                'code'
            ],
        ];
    }
}