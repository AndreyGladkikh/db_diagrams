<?php


namespace App\Model\User\Service;


class PasswordHasher
{
    public function hash(string $password): string
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if($hash === false) {
            throw new \Exception('Unable to generate hash');
        }
        return $hash;
    }
}