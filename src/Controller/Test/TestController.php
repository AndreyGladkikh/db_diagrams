<?php


namespace App\Controller\Test;


use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\ResetToken;
use App\Model\User\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test")
     */
    public function test()
    {
        $now = new \DateTimeImmutable();
        $token = new ResetToken('token', $now->modify('+1 day'));

        $user = new User(
            Id::next(),
            new \DateTimeImmutable()
        );
        $user->signUpByEmail(
            new Email('test@test.com'),
            'hash',
            'token'
        );
        $user->requestPasswordReset($token, $now);

        $token = new ResetToken('token', $now->modify('+3 day'));
        $user->requestPasswordReset($token, $now->modify('+2 day'));

    }
}