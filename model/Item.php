<?php
class Item
{
    private $id;
    private $desciption;
    private $price;
    private $comments;
    
    function __construct($desciption = null, $price = null, $comments = null, $id = null) {
        $this->id = $id;
        $this->desciption = $desciption;
        $this->price = $price;
        $this->comments = $comments;
    }
    
    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->desciption;
    }

    function getPrice() {
        return $this->price;
    }

    function getComments() {
        return $this->comments;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescription($desciption) {
        $this->desciption = $desciption;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setComments($comments) {
        $this->comments = $comments;
    }



}
