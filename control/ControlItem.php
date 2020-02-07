<?php

class ControlItem {

    private $item;
    private $dao;
    private $errors;

    function __construct() {
        $this->item = new Item();
        $this->dao = new DaoItem();
        $this->errors = array();
    }

    function insert($desciption, $price, $comments) {
        if (!strlen($desciption)) {
            $this->errors[] = "Missing description";
        }
        if (!strlen($price)) {
            $this->errors[] = "Missing price";
        }
        if (!strlen($comments)) {
            $this->errors[] = "Missing comments";
        }
        if (!$this->errors) {
            $this->item = new Item($desciption, $price, $comments);
            $this->dao->insert($this->item);
        }
    }

    function update($desciption, $price, $comments, $id) {
        if (!strlen($desciption)) {
            $this->errors[] = "Preencha o campo descrição";
        }
        if (!strlen($price)) {
            $this->errors[] = "Missing price";
        }
        if (!strlen($comments)) {
            $this->errors[] = "Missing comments";
        }

        if (!$this->errors) {
            $this->item = new Item($desciption, $price, $comments, $id);
            return $this->dao->update($this->item);
        }else{
            return 0;
        }
    }

    function delete($id) {
        return $this->dao->delete($id);
    }

    function select($id) {
        return $this->dao->select($id);
    }

    function list() {
        return $this->dao->list();
    }

    function getErrors()
    {
        return $this->errors;
    }

}
