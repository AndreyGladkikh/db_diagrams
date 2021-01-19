<?php


namespace App\Model\Project\UseCase\Table\CreateBulk;


use App\Model\Flusher;
use App\Model\Project\Entity\Project\Id as ProjectId;
use App\Model\Project\Entity\Project\ProjectRepository;
use App\Model\Project\Entity\Table\Id;
use App\Model\Project\Entity\Table\Table;
use App\Model\Project\Entity\Table\TableRepository;

class Handler
{
    /**
     * @var TableRepository
     */
    private $tables;
    /**
     * @var Flusher
     */
    private $flusher;
    /**
     * @var ProjectRepository
     */
    private $projects;

    public function __construct(ProjectRepository $projects, TableRepository $tables, Flusher $flusher)
    {
        $this->tables = $tables;
        $this->flusher = $flusher;
        $this->projects = $projects;
    }

    public function handle(Command $command)
    {
        $project = $this->projects->get(new ProjectId($command->projectId));
        foreach($command->tables as $table) {
            $this->tables->add(new Table(
                Id::next(),
                $table['name'],
                $table['description'],
                $table['definition'],
                $table['domElementCoordinates'],
                $project
            ));
        }
        $this->flusher->flush();
    }
}