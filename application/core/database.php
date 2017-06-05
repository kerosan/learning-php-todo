<?php

/**
 * Class Database
 */
class Database
{
    /**
     * @var SQLiteDatabase
     */
    private $connection;
    private static $_instance = null;

    private function __construct()
    {
//        $this->connection = sqlite_open('application/models/db.sqlite');
        $this->connection = new PDO('sqlite:application/models/db.sqlite3');
//        die(var_dump($this->connection));
    }

    protected function __clone()
    {
    }

    static public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    /**
     * @return SQLiteDatabase
     */
    public function getConnection()
    {
        return $this->connection;
    }

}