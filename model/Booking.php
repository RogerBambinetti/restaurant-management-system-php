<?php
class Booking
{
    private $id;
    private $status;
    private $time;
    private $idTable;
    private $idClient;
    
    function __construct($status = null, $time = null, $idTable = null, $idClient = null, $id = null) {
        $this->id = $id;
        $this->status = $status;
        $this->time = $time;
        $this->idTable = $idTable;
        $this->idClient = $idClient;
    }
    
    function getId() {
        return $this->id;
    }

    function getStatus() {
        return $this->status;
    }

    function getTime() {
        return $this->time;
    }

    function getIdTable() {
        return $this->idTable;
    }

    function getIdClient() {
        return $this->idClient;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function setIdTable($idTable) {
        $this->idTable = $idTable;
    }

    function setIdClient($idClient) {
        $this->idClient = $idClient;
    }



}
