<?php

class Model
{
    protected $connection;
    protected $tableName;

    function __construct()
    {
    }

    protected function getConnection()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    protected function getById($id)
    {
        $sql = sprintf("SELECT * FROM %s WHERE id = %d", $this->tableName, $id);
        /** @var PDOStatement $statement */
        $statement = $this->connection->query($sql);
        $ret = $statement->fetchAll();
        $statement = null;
        $this->connection = null;
        return $ret;
    }

}