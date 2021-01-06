<?php


namespace App\Model\User\UseCase\ResetPassword\Reset;


use App\Model\User\Entity\User\UserRepository;
use App\Model\User\Service\PasswordHasher;

class Handler
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var PasswordHasher
     */
    private $passwordHasher;

    public function __construct(UserRepository $users, PasswordHasher $passwordHasher)
    {
        $this->users = $users;
        $this->passwordHasher = $passwordHasher;
    }

    public function handle(Command $command)
    {
        if (!$user = $this->users->findByResetToken($command->token)) {
            throw new \Exception('Incorrect or confirmed token');
        }

        $user->resetPassword(
            new \DateTimeImmutable(),
            $this->passwordHasher->hash($command->password)
        );
    }
}