<?php


namespace App\Tests\Builder\Project;


use App\Model\Project\Entity\Project\Id;
use App\Model\Project\Entity\Project\Project;
use App\Model\User\Entity\User\User;
use App\Tests\Builder\User\UserBuilder;

class ProjectBuilder
{
    private $id;
    private $name;
    private $description;
    private $user;

    public function __construct(string $name = null, string $description = null, User $user = null)
    {
        $this->id = Id::next();
        $this->name = $name ?? 'test_name';
        $this->description = $description ?? 'test_description';
        $this->user = $user ?? (new UserBuilder())->viaEmail()->build();
    }

    public function build(): Project
    {
        return new Project(
            $this->id,
            $this->name,
            $this->description,
            $this->user
        );
    }
}