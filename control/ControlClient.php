<?php

class ControlClient
{

    private $client;
    private $dao;
    private $errors;

    function __construct()
    {
        $this->client = new Client();
        $this->dao = new DaoClient();
        $this->errors = array();
    }

    function insert($cpf, $name, $birthday, $address, $email, $password, $confirmPassword)
    {
        if (!strlen($cpf)) {
            $this->errors[] = "Missing CPF";
        }
        if (!strlen($name)) {
            $this->errors[] = "Missing name";
        }
        if (!strlen($birthday)) {
            $this->errors[] = "Missing birthday";
        }
        if (!strlen($address)) {
            $this->errors[] = "Missing address";
        }
        if (!strlen($email)) {
            $this->errors[] = "Missing e-mail";
        }
        if ($this->dao->checkEmail(new Client(0, 0, 0, 0, $email, 0, 0))) {
            $this->errors[] = "E-mail already in use";
        }
        if (!strlen($password)) {
            $this->errors[] = "Missing password";
        } else if (strlen($password) < 6) {
            $this->errors[] = "Password needs at least 6 characters";
        } else if ($password != $confirmPassword) {
            $this->errors[] = "Passwords don't match";
        }

        if (!$this->errors) {
            $this->client = new Client($cpf, $name, $birthday, $address, $email, md5($password));
            $this->dao->insert($this->client);
        }
    }

    function update($cpf, $name, $birthday, $address, $email, $password, $confirmPassword, $id)
    {
        if (!strlen($cpf)) {
            $this->errors[] = "Missing CPF";
        }
        if (!strlen($name)) {
            $this->errors[] = "Missing name";
        }
        if (!strlen($birthday)) {
            $this->errors[] = "Missing birthday";
        }
        if (!strlen($address)) {
            $this->errors[] = "Missing address";
        }
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
            $this->client = new Client($cpf, $name, $birthday, $address, $email, md5($password), $id);
            $this->dao->update($this->client);
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

    function listBirthdays($date)
    {
        $date = new DateTime($date);
        return $this->dao->listBirthdays($date);
    }

    function login($email, $password)
    {
        $this->client = new Client(0, 0, 0, 0, $email, md5($password));
        if ($this->dao->checkEmail($this->client)) {
            if ($this->dao->login($this->client)) {
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
        $_SESSION["email"] = null;
    }

    function checkEmail($email)
    {
        $this->client = new Client(0, 0, 0, 0, $email, 0, 0);
        return $this->dao->checkEmail($this->client);
    }

    function setVisits($idClient, $visits, $quantidadeVisits)
    {
        $this->client = new Client(0, 0, 0, 0, 0, 0, $idClient, ($visits - $quantidadeVisits));
        $this->dao->setVisits($this->client);
    }

    function countVisit($idClient)
    {
        return $this->dao->countVisit($idClient);
    }

    function getErrors()
    {
        return $this->errors;
    }
}
