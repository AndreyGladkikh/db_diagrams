<?php


namespace App\Model\Project\UseCase\Table\CreateBulk;


class Command
{
    /**
     * @var string
     */
    public $projectId;
    /**
     * @var array
     */
    public $tables;

    public function __construct(string $projectId, array $tables)
    {
        $this->projectId = $projectId;
        $this->tables = $tables;
    }
}