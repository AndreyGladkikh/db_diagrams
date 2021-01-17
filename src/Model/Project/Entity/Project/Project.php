<?php


namespace App\Model\Project\Entity\Project;


use App\Model\Project\Entity\Table\Table;
use App\Model\User\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\Table("project_projects")
 */
class Project
{
    use TimestampableEntity;

    /**
     * @var Id
     * @ORM\Column(type="project_project_id")
     * @ORM\Id()
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;
    /**
     * @var Table
     * @ORM\OneToMany(targetEntity="App\Model\Project\Entity\Table\Table", mappedBy="project")
     */
    private $tables;
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Model\User\Entity\User\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    public function __construct(Id $id, string $name, string $description, User $user)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->user = $user;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}