<?php
require 'table/todo.php';

class Model_Main
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
