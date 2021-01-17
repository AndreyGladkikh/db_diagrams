<?php


namespace App\ReadModel\User;


use Doctrine\DBAL\Connection;

class UserFetcher
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getList()
    {
        return $this->connection->createQueryBuilder()
            ->select('id, email')
            ->from('user_users')
            ->execute()->fetchAll();
    }
}