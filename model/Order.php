<?php
class Order
{

    private $id;
    private $status;
    private $idClient;
    private $idTable;
    
    function __construct($status = null, $idClient = null, $idTable = null, $id = null) {
        $this->id = $id;
        $this->status = $status;
        $this->idClient = $idClient;
        $this->idTable = $idTable;
    }
    
    function getId() {
        return $this->id;
    }

    function getStatus() {
        return $this->status;
    }

    function getIdClient() {
        return $this->idClient;
    }

    function getIdTable() {
        return $this->idTable;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    function setIdTable($idTable) {
        $this->idTable = $idTable;
    }

}
