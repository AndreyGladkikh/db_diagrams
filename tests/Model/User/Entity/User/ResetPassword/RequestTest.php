<?php


namespace App\Tests\Model\User\Entity\User\ResetPassword;


use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\ResetToken;
use App\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testSuccess()
    {
        $user = $this->buildUserSignedUpByEmail();
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
        $user = $this->buildUserSignedUpByEmail();
        $user->requestPasswordReset($token, $now);

        self::expectExceptionMessage('Resetting is already requested.');
        $user->requestPasswordReset($token, $now);
    }

    public function testExpired()
    {
        $now = new \DateTimeImmutable();
        $token = new ResetToken('token', $now->modify('+1 day'));
        $user = $this->buildUserSignedUpByEmail();
        $user->requestPasswordReset($token, $now);
        self::assertEquals($token, $user->getResetToken());
        $token = new ResetToken('token', $now->modify('+3 day'));
        $user->requestPasswordReset($token, $now->modify('+2 day'));
        self::assertEquals($token, $user->getResetToken());
    }

    public function testWithoutEmail()
    {

    }

    private function buildUserSignedUpByEmail(): User
    {
        $user = new User(
            Id::next(),
            new \DateTimeImmutable()
        );
        $user->signUpByEmail(
            new Email('test@test.com'),
            'hash',
            'token'
        );
        return $user;
    }
}