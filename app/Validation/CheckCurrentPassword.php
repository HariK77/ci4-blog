<?php

namespace App\Validation;

use App\Models\User;

class CheckCurrentPassword
{
    public function check_current_password(string $str, string $fields, array $data): bool
    {
        $model = new User();
        $user = $model->find(session('id'));
        return password_verify($data['current_password'], $user->password);
    }
}
