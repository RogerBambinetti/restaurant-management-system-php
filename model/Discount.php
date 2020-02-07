<?php
class Discount
{
    private $visitsNumber;
    private $visitsDiscount;
    private $consumesNumber;
    private $consumesDiscount;
    private $birthdayDiscount;
    
    function __construct($visitsNumber = null, $visitsDiscount = null, $consumesNumber = null, $consumesDiscount = null, $birthdayDiscount = null) {
        $this->visitsNumber = $visitsNumber;
        $this->visitsDiscount = $visitsDiscount;
        $this->consumesNumber = $consumesNumber;
        $this->consumesDiscount = $consumesDiscount;
        $this->birthdayDiscount = $birthdayDiscount;
    }
    function getVisitsNumber() {
        return $this->visitsNumber;
    }

    function getVisitsDiscount() {
        return $this->visitsDiscount;
    }

    function getConsumesNumber() {
        return $this->consumesNumber;
    }

    function getConsumesDiscount() {
        return $this->consumesDiscount;
    }

    function getBirthdayDiscount() {
        return $this->birthdayDiscount;
    }

    function setVisitsNumber($visitsNumber) {
        $this->visitsNumber = $visitsNumber;
    }

    function setVisitsDiscount($visitsDiscount) {
        $this->visitsDiscount = $visitsDiscount;
    }

    function setConsumesNumber($consumesNumber) {
        $this->consumesNumber = $consumesNumber;
    }

    function setConsumesDiscount($consumesDiscount) {
        $this->consumesDiscount = $consumesDiscount;
    }

    function setBirthdayDiscount($birthdayDiscount) {
        $this->birthdayDiscount = $birthdayDiscount;
    }


}
