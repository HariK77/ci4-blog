<?php

namespace App\Validation;

class SameAsCurrentPassword
{
    public function same_current_password(string $str, string $fields, array $data): bool
    {
        if(strcmp($data['current_password'], $data['password']) == 0){
            return false;
        }
        return true;
        
    }
}
