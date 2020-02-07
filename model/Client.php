<?php
class Client
{ 
    private $id;
    private $cpf;
    private $name;
    private $birthday;
    private $address;
    private $email;
    private $password;
    private $visits;
    
    function __construct($cpf = null, $name = null, $birthday = null, $address = null, $email = null, $password = null, $id = null, $visits = null) {
        $this->id = $id;
        $this->cpf = $cpf;
        $this->name = $name;
        $this->birthday = $birthday;
        $this->address = $address;
        $this->email = $email;
        $this->password = $password;
        $this->visits = $visits;
    }

    
    function getId() {
        return $this->id;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getName() {
        return $this->name;
    }

    function getBirthday() {
        return $this->birthday;
    }

    function getAddress() {
        return $this->address;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getVisits(){
        return $this->visits;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
    function setVisits($visits) {
        $this->visits = $visits;
    }

}
