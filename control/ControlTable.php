<?php

class ControlTable
{

    private $table;
    private $dao;
    private $errors;

    function __construct()
    {
        $this->table = new Table();
        $this->dao = new DaoTable();
        $this->errors = array();
    }

    function insert($number, $seats)
    {

        if (!strlen($number)) {
            $this->errors[] = "Missing table";
        }
        if (!strlen($seats)) {
            $this->errors[] = "Missing seats";
        }

        if (!$this->errors) {
            $this->table = new Table($number, $seats);
            $this->dao->insert($this->table);
        }
    }

    function update($number, $seats, $id)
    {

        if (!strlen($number)) {
            $this->errors[] = "Missing number";
        }
        if (!strlen($seats)) {
            $this->errors[] = "Missing seats";
        }

        if (!$this->errors) {
            $this->table = new Table($number, $seats, $id);
            $this->dao->update($this->table);
        }
    }

    function delete($id)
    {
        return $this->dao->delete($id);
    }

    function selectByNumber($number)
    {
        return $this->dao->selectByNumber($number);
    }

    function select($id)
    {
        return $this->dao->select($id);
    }

    function list()
    {
        return $this->dao->list();
    }

    function getErrors()
    {
        return $this->errors;
    }

}
