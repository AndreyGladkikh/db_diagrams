<?php


namespace App\Tests\Model\User\Entity\User\ChangeRole;


use App\Model\User\Entity\User\Role;
use App\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testSuccess()
    {
        $user = (new UserBuilder())->viaEmail()->build();
        $user->changeRole(Role::admin());
        self::assertFalse($user->getRole()->isUser());
        self::assertTrue($user->getRole()->isAdmin());
    }

    public function testAlready()
    {
        $user = (new UserBuilder())->viaEmail()->build();
        self::expectExceptionMessage('Role is already the same.');
        $user->changeRole(Role::user());
    }
}