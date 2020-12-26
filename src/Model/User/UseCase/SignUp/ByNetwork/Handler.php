<?php


namespace App\Model\User\UseCase\SignUp\ByNetwork;


use App\Model\Flusher;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\User;
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

    public function __construct(
        UserRepository $users,
        Flusher $flusher
    )
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    public function handle()
    {
        if($this->users->hasByNetworkIdentity()) {
            throw new \Exception('User already exists.');
        }

        $user = new User(
            Id::next(),
            new \DateTimeImmutable()
        );

        $user->signUpByNetwork();
        $this->users->add($user);
        $this->flusher->flush();
    }
}