<?php
require 'table/todo.php';

class Model_Todo
{
    public $todoTable;

    function __construct()
    {

    }

    public function getTable()
    {
        if (!$this->todoTable) {
            $this->todoTable = new Todo();
        }
        return $this->todoTable;
    }
}
