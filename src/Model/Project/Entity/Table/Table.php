<?php


namespace App\Model\Project\Entity\Table;


use App\Model\Project\Entity\Project\Project;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\Table("project_tables")
 */
class Table
{
    use TimestampableEntity;

    /**
     * @var Id
     * @ORM\Column(type="project_table_id")
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
     * @var string
     * @ORM\Column(type="json")
     */
    private $definition;
    /**
     * @var string
     * @ORM\Column(type="json")
     */
    private $domElementCoordinates;
    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="App\Model\Project\Entity\Project\Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     */
    private $project;

    public function __construct(
        Id $id, string $name,
        string $description,
        string $definition,
        string $domElementCoordinates,
        Project $project
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->definition = $definition;
        $this->domElementCoordinates = $domElementCoordinates;
        $this->project = $project;
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
     * @return string
     */
    public function getDefinition(): string
    {
        return $this->definition;
    }

    /**
     * @return string
     */
    public function getDomElementCoordinates(): string
    {
        return $this->domElementCoordinates;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
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

    /**
     * @param string $definition
     */
    public function setDefinition(string $definition): void
    {
        $this->definition = $definition;
    }

    /**
     * @param string $domElementCoordinates
     */
    public function setDomElementCoordinates(string $domElementCoordinates): void
    {
        $this->domElementCoordinates = $domElementCoordinates;
    }
}