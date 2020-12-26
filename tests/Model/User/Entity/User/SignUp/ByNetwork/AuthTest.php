<?php


namespace App\Tests\Model\User\Entity\User\SignUp\ByNetwork;


use App\Model\User\Entity\User\Id;
use App\Model\User\Entity\User\Network;
use App\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testSuccess()
    {
        $user = new User(
            $id = Id::next(),
            $created_at = new \DateTimeImmutable()
        );
        $user->signUpByNetwork(
            $network = 'network',
            $identity = 'identity'
        );

        self::assertTrue($user->isActive());
        self::assertEquals($id, $user->getId());
        self::assertEquals($created_at, $user->getCreatedAt());
        self::assertCount(1, $networks = $user->getNetworks());
        self::assertInstanceOf(Network::class, $first = reset($networks));
        self::assertEquals($network, $first->getNetwork());
        self::assertEquals($identity, $first->getIdentity());
    }

    public function testAlready()
    {
        $user = new User(
            $id = Id::next(),
            $created_at = new \DateTimeImmutable()
        );
        $user->signUpByNetwork(
            $network = 'network',
            $identity = 'identity'
        );

        self::expectExceptionMessage('User already signed up.');

        $user->signUpByNetwork(
            $network = 'network',
            $identity = 'identity'
        );
    }
}