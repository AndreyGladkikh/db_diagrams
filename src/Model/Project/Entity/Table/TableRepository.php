<?php


namespace App\Model\Project\Entity\Table;


use App\Model\User\Entity\User\Id;
use Doctrine\ORM\EntityManagerInterface;

class TableRepository
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
        $this->repo = $em->getRepository(Table::class);
    }

    public function add(Table $table): void
    {
        $this->em->persist($table);
    }

    public function get(Id $id): Table
    {
        if(!$item = $this->repo->find($id)) {
            throw new \Exception('Table is not found.');
        }
        return $item;
    }
}