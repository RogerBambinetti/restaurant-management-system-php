<?php
class Table
{
    private $id;
    private $number;
    private $seats;
    
    function __construct($number = null, $seats = null, $id = null) {
        $this->id = $id;
        $this->number = $number;
        $this->seats = $seats;
    }
    
    function getId() {
        return $this->id;
    }

    function getNumber() {
        return $this->number;
    }

    function getSeats() {
        return $this->seats;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumber($number) {
        $this->number = $number;
    }

    function setSeats($seats) {
        $this->seats = $seats;
    }



}
