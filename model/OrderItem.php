<?php
class OrderItem
{
    private $idOrder;
    private $idItem;
    private $number;
    
    function __construct($idOrder, $idItem, $number) {
        $this->idOrder = $idOrder;
        $this->idItem = $idItem;
        $this->number = $number;
    }
    
    function getIdOrder() {
        return $this->idOrder;
    }

    function getIdItem() {
        return $this->idItem;
    }

    function setIdOrder($idOrder) {
        $this->idOrder = $idOrder;
    }

    function setIdItem($idItem) {
        $this->idItem = $idItem;
    }

    function getNumber(){
        return $this->number;
    }

    function setNumber($number)
    {
        $this->number = $number;
    }



}
