<?php

namespace App\Validation;

use App\Models\UserModel;

class UserRules {
    public function validateUser($str, $field, $data) {
        try {
            $model = new UserModel();
            $user = $model->findUserByEmailAddress($data['id']);
            return password_verify($data['pwd'], $user['pwd']);
        } catch (\Exception $e) {
            return false;
        }
    }
}