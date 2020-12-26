<?php


namespace App\Model\User\UseCase\SignUp\ByNetwork;


class Command
{
    /**
     * @var string
     */
    public $network;
    /**
     * @var string
     */
    public $identity;
}