<?php

namespace app\services;

use app\entities\User;
use app\forms\LoginForm;
use DomainException;

class AuthService
{
    public function auth(LoginForm $form): User
    {
        $user = User::find()->active()->byEmail($form->email)->one();
        if (!$user) {
            throw new DomainException('No user found');
        }
        if (!$isValidPassword = $user->validatePassword($form->password)) {
            throw new DomainException('Incorrect password');
        }

        return $user;
    }
}
