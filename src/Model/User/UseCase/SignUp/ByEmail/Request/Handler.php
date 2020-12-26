<?php


namespace App\Model\User\UseCase\SignUp\ByEmail\Request;


use App\Model\Flusher;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\UserRepository;
use App\Model\User\Service\ConfirmTokenizer;
use App\Model\User\Service\ConfirmTokenSender;
use App\Model\User\Service\PasswordHasher;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var Flusher
     */
    private $flusher;
    /**
     * @var PasswordHasher
     */
    private $passwordHasher;
    /**
     * @var ConfirmTokenizer
     */
    private $tokenizer;
    /**
     * @var ConfirmTokenSender
     */
    private $sender;

    public function __construct(
        UserRepository $users,
        PasswordHasher $passwordHasher,
        ConfirmTokenizer $tokenizer,
        Flusher $flusher,
        ConfirmTokenSender $sender
    )
    {
        $this->users = $users;
        $this->flusher = $flusher;
        $this->passwordHasher = $passwordHasher;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
    }

    public function handle(Command $command): void
    {
        $email = new Email($command->email);
        if($this->users->hasByEmail($email)) {
            throw new \Exception(sprintf("User with email '%s' already exists.", $email));
        }

        $user = new User(
            Id::next(),
            new \DateTimeImmutable()
        );

        $user->signUpByEmail(
            new Email($email),
            $this->passwordHasher->hash($command->password),
            $token = $this->tokenizer->generate()
        );

        $this->users->add($user);
        $this->sender->send($email, $token);
        $this->flusher->flush();
    }
}