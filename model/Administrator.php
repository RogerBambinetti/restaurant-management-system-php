<?php
class Administrator
{
    private $id;
    private $email;
    private $password;
    
    function __construct($email = null, $password = null, $id = null) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    
    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }


}
