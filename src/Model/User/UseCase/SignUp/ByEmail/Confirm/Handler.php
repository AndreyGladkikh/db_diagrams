<?php


namespace App\Model\User\UseCase\SignUp\ByEmail\Confirm;


use App\Model\Flusher;
use App\Model\User\Entity\User\UserRepository;

class Handler
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var Flusher
     */
    private $flusher;

    public function __construct(UserRepository $users, Flusher $flusher)
    {

        $this->users = $users;
        $this->flusher = $flusher;
    }

    public function handle(Command $command)
    {
        if(!$user = $this->users->findByConfirmToken($command->token)) {
            throw new \Exception('Incorrect or confirmed token.');
        }
        $user->confirmSignUp();
        $this->flusher->flush();
    }
}