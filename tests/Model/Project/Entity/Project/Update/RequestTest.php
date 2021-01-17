<?php


namespace App\Tests\Model\Project\Entity\Project\Update;


use App\Model\Project\Entity\Project\Id;
use App\Model\Project\Entity\Project\Project;
use App\Tests\Builder\Project\ProjectBuilder;
use App\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testSuccess()
    {
        $project = (new ProjectBuilder())->build();
        $project->setName($name = 'new_name');
        $project->setDescription($description = 'new_description');

        self::assertEquals($project->getName(), $name);
        self::assertEquals($project->getDescription(), $description);
    }
}