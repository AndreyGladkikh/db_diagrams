<?php


namespace App\Tests\Model\User\Entity\User\SignUp;


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
            $email = new Email('test@test.com'),
            $passwordHash = 'passwordHash',
            $token = (new ConfirmTokenizer())->generate(),
            $createdAt = new \DateTimeImmutable()
        );

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());

        self::assertEquals($id, $user->getId());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($passwordHash, $user->getPasswordHash());
        self::assertEquals($token, $user->getToken());
        self::assertEquals($createdAt, $user->getCreatedAt());
    }
}