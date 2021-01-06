<?php


namespace App\Tests\Model\User\Entity\User\ResetPassword;


use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\ResetToken;
use App\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;

class ResetTest extends TestCase
{
    public function testSuccess()
    {
        $now = new \DateTimeImmutable();
        $user = $this->buildUserSignedUpByEmail();
        $user->requestPasswordReset(
            new ResetToken('token', $now->modify('+1 day')),
            new \DateTimeImmutable()
        );
        self::assertNotNull($user->getResetToken());
        $user->resetPassword($now, $newPass = 'newHash');
        self::assertEquals($newPass, $user->getPasswordHash());
    }

    public function testNotRequested()
    {
        $now = new \DateTimeImmutable();
        $user = $this->buildUserSignedUpByEmail();
        self::expectExceptionMessage('Resetting is not requested.');
        $user->resetPassword($now, 'newHash');
    }

    public function testResetTokenIsExpired()
    {
        $now = new \DateTimeImmutable();
        $user = $this->buildUserSignedUpByEmail();
        $user->requestPasswordReset(
            new ResetToken('token', $now),
            new \DateTimeImmutable()
        );
        self::expectExceptionMessage('Reset token is expired.');
        $user->resetPassword($now->modify('+1 day'), $newPass = 'newHash');
    }

    private function buildUserSignedUpByEmail(): User
    {
        $user = new User(
            Id::next(),
            new \DateTimeImmutable()
        );
        $user->signUpByEmail(
            new Email('test@test.test'),
            'hash',
            'token'
        );
        return $user;
    }
}