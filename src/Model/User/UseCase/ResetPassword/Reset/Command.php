<?php


namespace App\Model\User\UseCase\ResetPassword\Reset;


class Command
{
    /**
     * @var string
     */
    public $token;
    /**
     * @var string
     */
    public $password;
}