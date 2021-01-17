<?php


namespace App\Model\User\UseCase\SignUp\ByEmail\Confirm;


class Command
{
    /**
     * @var string
     */
    public $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }
}