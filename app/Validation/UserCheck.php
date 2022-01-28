<?php

namespace App\Validation;

use App\Models\User;

class UserCheck
{
    // public function custom_rule(): bool
    // {
    //     return true;
    // }
    public function validate_user(string $str, string $fields, array $data)
    {
        $model = new User();
        $user = $model->asObject()->where('email', $data['email'])->first();

        if (!$user) return false;
        
        return password_verify($data['password'], $user->password);
    }
}
