<?php


namespace App\Model\User\Entity\User;


class UserRepository
{
    public function __construct()
    {
    }

    public function findByConfirmToken(string $token): User
    {

    }

    public function hasByEmail(Email $email): bool
    {

    }

    public function add(User $user)
    {

    }
}