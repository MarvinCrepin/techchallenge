<?php

namespace App\Model;

class MembersManager extends AbstractManager
{
    public const TABLE = 'members';

    /**
     * Insert new member in database
     */
    public function insert(array $member): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`) VALUES (:name)");
        $statement->bindValue('name', $member['name'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
