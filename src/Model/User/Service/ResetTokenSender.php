<?php


namespace App\Model\User\Service;


use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\ResetToken;

class ResetTokenSender
{
    public function send(Email $email, ResetToken $token): void
    {

    }
}