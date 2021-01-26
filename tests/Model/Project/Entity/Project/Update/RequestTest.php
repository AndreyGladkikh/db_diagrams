<?php


namespace App\Tests\Model\Project\Entity\Project\Update;


use App\Model\Project\Entity\Project\Id;
use App\Model\Project\Entity\Project\Project;
use App\Model\User\Entity\User\User;
use App\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testSuccess()
    {
        $project = new Project(
            Id::next(),
            'test_name',
            'test_description',
            (new UserBuilder())->viaEmail()->build()
        );
        $project->setName($name = 'new_name');
        $project->setDescription($description = 'new_description');

        self::assertEquals($project->getName(), $name);
        self::assertEquals($project->getDescription(), $description);
    }
}