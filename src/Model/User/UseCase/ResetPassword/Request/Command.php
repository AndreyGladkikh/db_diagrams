<?php


namespace App\Model\User\UseCase\ResetPassword\Request;


class Command
{
    /**
     * @var string
     */
    public $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}