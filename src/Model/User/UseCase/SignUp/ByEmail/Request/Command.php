<?php


namespace App\Model\User\UseCase\SignUp\ByEmail\Request;


class Command
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;
}