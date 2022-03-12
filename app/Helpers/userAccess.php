<?php

if(!function_exists('defaultUserAccessRole')){
    function defaultUserAccessRole(){
        return [
            'user' => [
                'transaction',
                // 'store'
            ],
            'admin' => [
                'user-permissions',
            ]
        ];
    }
}