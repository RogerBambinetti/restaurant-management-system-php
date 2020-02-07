<?php

class ControlAdministrator
{

    private $administrator;
    private $dao;
    private $errors;

    function __construct()
    {
        $this->administrator = new Administrator();
        $this->dao = new DaoAdministrator();
        $this->errors = array();
    }

    function insert($email, $password, $confirmPassword)
    {
        if (!strlen($email)) {
            $this->errors[] = "Missing e-mail";
        }
        if (!strlen($password)) {
            $this->errors[] = "Missing password";
        } else if (strlen($password) < 6) {
            $this->errors[] = "Password needs at least 6 characters";
        } else if ($password != $confirmPassword) {
            $this->errors[] = "Passwords don't match";
        }

        if (!$this->errors) {
            $this->administrator = new Administrator($email, md5($password));
            $this->dao->insert($this->administrator);
        }
    }

    function update($email, $password, $confirmPassword, $id)
    {
        if (!strlen($email)) {
            $this->errors[] = "Missing e-mail";
        }
        if (!strlen($password)) {
            $this->errors[] = "Missing password";
        } else if (strlen($password) < 6) {
            $this->errors[] = "Password needs at least 6 characters";
        } else if ($password != $confirmPassword) {
            $this->errors[] = "Passwords don't match";
        }

        if (!$this->errors) {
            $this->administrator = new Administrator($email, $password, $id);
            $this->dao->update($this->administrator);
        }
    }

    function delete($id)
    {
        return $this->dao->delete($id);
    }
    
    function select($id)
    {
        return $this->dao->select($id);
    }

    function list()
    {
        return $this->dao->list();
    }

    function login($email, $password)
    {
        $this->administrator = new Administrator($email, md5($password));
        if ($this->dao->checkEmail($this->administrator)) {
            if ($this->dao->login($this->administrator)) {
                return 1;
            } else {
                $this->errors[] = "Invalid data";
                return 0;
            }
        } else {
            $this->errors[] = "Invalid data";
            return 0;
        }
    }

    function logout()
    {
        session_start();
        $_SESSION["emailAdministrator"] = null;
    }

    function getErrors()
    {
        return $this->errors;
    }
}
