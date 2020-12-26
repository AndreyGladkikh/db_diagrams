<?php


namespace App\Tests\Model\User\Entity\User\SignUp;


use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;

class ConfirmTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = $this->buildSignedUpUser();

        $user->confirmSignUp();
        self::assertTrue($user->isActive());
        self::assertFalse($user->isWait());
        self::assertNull($user->getToken());
    }

    public function testAlready(): void
    {
        $user = $this->buildSignedUpUser();
        $user->confirmSignUp();
        self::expectExceptionMessage('User already confirmed.');
        $user->confirmSignUp();
    }

    private function buildSignedUpUser(): User
    {
        return new User(
            Id::next(),
            new Email('test@test.com'),
            'passHash',
            'token',
            new \DateTimeImmutable()
        );
    }
}