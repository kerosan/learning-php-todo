<?php

/**
 * Table Todo
 */
class Todo extends Model
{
    function __construct()
    {
        $this->tableName = 'todo';
    }

    /**
     * @return int
     */
    public function getCount()
    {
        parent::getConnection();
        $sql = sprintf("SELECT COUNT(0) FROM %s", $this->tableName);
        /** @var PDOStatement $statement */
        $statement = $this->connection->query($sql);
        $ret = $statement->fetchAll();
        $statement = null;
        $this->connection = null;
        return $ret[0][0];
    }

    public function getItemList($start = null, $offset = null, $order = null, $sort = null)
    {
        parent::getConnection();
        $sorting = '';
        if (!is_null($order) && !is_null($sort)) {
            $sorting = ' ORDER BY ' . $order . ' ' . strtoupper($sort);
        }
        if (!is_null($start) && !is_null($offset)) {
            $sql = sprintf("SELECT * FROM %s %s LIMIT %d OFFSET %d", $this->tableName, $sorting, $offset, $start);
        } else {
            $sql = sprintf("SELECT * FROM %s %s LIMIT %d OFFSET %d", $this->tableName, $sorting, $offset, 0);
        }
        /** @var PDOStatement $statement */
        $statement = $this->connection->query($sql);
        $ret = $statement->fetchAll();
        $statement = null;
        $this->connection = null;
        return $ret;
    }

    public function createTask($data)
    {
        parent::getConnection();

        $sql = sprintf("INSERT INTO %s (name, email, TEXT, FILE, ready, deleted) VALUES ('%s', '%s', '%s', '%s', %d, %d)", $this->tableName, $data['name'], $data['email'], $data['text'], $data['file'], $data['ready'], $data['deleted']);

        /** @var PDOStatement $statement */
        $statement = $this->connection->prepare($sql);
        $ret = $statement->execute();
        $statement = null;
        $this->connection = null;
        return $ret;
    }

    public function updateTask($data)
    {
        parent::getConnection();

        $sql = sprintf("UPDATE %s SET `text` = '%s', `ready` = %d WHERE `id` = %d", $this->tableName, $data['text'], $data['ready'], $data['id']);
        /** @var PDOStatement $statement */
        $statement = $this->connection->prepare($sql);
        $ret = $statement->execute();
        $statement = null;
        $this->connection = null;
        return $ret;
    }
}
