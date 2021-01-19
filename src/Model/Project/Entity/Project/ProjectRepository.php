<?php


namespace App\Model\Project\Entity\Project;


use Doctrine\ORM\EntityManagerInterface;

class ProjectRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Project::class);
    }

    public function add(Project $project): void
    {
        $this->em->persist($project);
    }

    public function get(Id $id): Project
    {
        if(!$item = $this->repo->find($id)) {
            throw new \Exception('Project is not found.');
        }
        return $item;
    }
}