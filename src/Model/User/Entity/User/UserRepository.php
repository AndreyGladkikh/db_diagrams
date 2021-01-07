<?php


namespace App\Model\User\Entity\User;


class UserRepository
{
    public function __construct()
    {
    }

    public function add(User $user)
    {

    }

    public function findByConfirmToken(string $token): User
    {

    }

    public function hasByEmail(Email $email): bool
    {

    }

    public function hasByNetworkIdentity(string $network, string $identity): bool
    {

    }

    public function get(Id $id): User
    {

    }

    public function getByEmail(Email $email): User
    {

    }

    public function findByResetToken(string $resetToken): User
    {

    }
}