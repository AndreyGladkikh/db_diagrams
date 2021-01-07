<?php


namespace App\Tests\Model\User\Entity\User\ResetPassword;


use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\ResetToken;
use App\Model\User\Entity\User\User;
use App\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testSuccess()
    {
        $user = (new UserBuilder())->viaEmail()->build();
        $user->requestPasswordReset(
            new ResetToken(
                $token = 'token',
                (new \DateTimeImmutable())->modify('+1 day')
            ),
            new \DateTimeImmutable()
        );

        self::assertEquals($token, $user->getResetToken()->getToken());
    }

    public function testAlready()
    {
        $now = new \DateTimeImmutable();
        $token = new ResetToken('token', $now->modify('+1 day'));
        $user = (new UserBuilder())->viaEmail()->build();
        $user->requestPasswordReset($token, $now);

        self::expectExceptionMessage('Resetting is already requested.');
        $user->requestPasswordReset($token, $now);
    }

    public function testExpired()
    {
        $now = new \DateTimeImmutable();
        $token = new ResetToken('token', $now->modify('+1 day'));
        $user = (new UserBuilder())->viaEmail()->build();
        $user->requestPasswordReset($token, $now);
        self::assertEquals($token, $user->getResetToken());
        $token = new ResetToken('token', $now->modify('+3 day'));
        $user->requestPasswordReset($token, $now->modify('+2 day'));
        self::assertEquals($token, $user->getResetToken());
    }

    public function testWithoutEmail()
    {
        $now = new \DateTimeImmutable();
        $token = new ResetToken('token', $now->modify('+1 day'));

        $user = new User(
            Id::next(),
            new \DateTimeImmutable()
        );

        self::expectExceptionMessage('Email is not specified.');
        $user->requestPasswordReset($token, $now);
    }
}