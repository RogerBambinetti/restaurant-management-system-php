<?php

class DaoClient
{

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=trabalhofinal", "root", "root");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    function insert(Client $client)
    {
        try {
            return $this->connection->exec("insert into clients "
                . "(cpf, name, birthday, address, email, password, visits)"
                . " values ('" . $client->getCpf() . "', "
                . "'" . $client->getName() . "', "
                . "'" . $client->getBirthday() . "', "
                . "'" . $client->getAddress() . "', "
                . "'" . $client->getEmail() . "', "
                . "'" . $client->getPassword() . "', "
                . "0)");
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return 0;
        }
    }

    function update(Client $client)
    {

        try {
            return $this->connection->exec(
                "update clients set 
                            cpf = '" . $client->getCpf() . "', 
                            name = '" . $client->getName() . "',
                            birthday = '" . $client->getBirthday() . "',
                            address = '" . $client->getAddress() . "', 
                            email = '" . $client->getEmail() . "', 
                            password = '" . $client->getPassword() . "'
                            where id = " . $client->getId()
            );
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function delete($id)
    {
        try {
            return $this->connection->exec("delete from clients where id = " . $id);
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function select($id)
    {
        try {
            return $this->connection->query("select * from clients where id = " . $id)->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }
    
    function list()
    {
        try {
            return $this->connection->query("select * from clients", PDO::FETCH_OBJ);
        } catch (PDOException $th) {
            return 0;
        }
    }

    function listBirthdays(DateTime $date)
    {
        try {

            return $this->connection->query(
                "SELECT * FROM clients WHERE month(birthday) = " . date_format($date, 'm') . " AND day(birthday) = " . date_format($date, 'd'),
                PDO::FETCH_OBJ
            );
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function checkEmail(Client $client)
    {
        try {
            return $this->connection->query("select * from clients where email = '" . $client->getEmail() . "'")->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function login(Client $client)
    {
        try {
            return $this->connection->query("select * from clients where email = '" . $client->getEmail() . "' and password = '" . $client->getPassword() . "'")->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function setVisits(Client $client)
    {
        try {
            $this->connection->exec("UPDATE clients
                                    SET visits = " . $client->getVisits() . "
                                    WHERE id = " . $client->getId());
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function countVisit($idClient)
    {
        try {
            $this->connection->exec("UPDATE clients
                                    SET visits = visits + 1 WHERE id = " . $idClient);
        } catch (PDOException $ex) {
            return 0;
        }
    }
}
