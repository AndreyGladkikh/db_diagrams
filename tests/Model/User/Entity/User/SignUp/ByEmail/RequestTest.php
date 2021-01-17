<?php


namespace App\Tests\Model\User\Entity\User\SignUp\ByEmail;


use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\User;
use App\Model\User\Service\ConfirmTokenizer;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testSuccess()
    {
        $user = new User(
            $id = Id::next(),
            $createdAt = new \DateTimeImmutable()
        );

        $user->signUpByEmail(
            $email = new Email('test@test.com'),
            $passwordHash = 'passwordHash',
            $token = (new ConfirmTokenizer())->generate()
        );

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());

        self::assertEquals($id, $user->getId());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($passwordHash, $user->getPasswordHash());
        self::assertEquals($token, $user->getConfirmToken());
        self::assertEquals($createdAt, $user->getCreatedAt());

        self::assertTrue($user->getRole()->isUser());
    }
}