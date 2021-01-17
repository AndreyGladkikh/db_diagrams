<?php


namespace App\Tests\Model\Project\Entity\Project\Create;


use App\Model\Project\Entity\Project\Id;
use App\Model\Project\Entity\Project\Project;
use App\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testSuccess()
    {
        $project = new Project(
            $id = new Id('25'),
            $name = 'qux',
            $description = 'descr',
            $user = (new UserBuilder())->viaEmail()->build()
        );

        self::assertEquals($project->getName(), $name);
        self::assertEquals($project->getDescription(), $description);
        self::assertEquals($project->getUser(), $user);
    }
}