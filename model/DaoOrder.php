<?php

class DaoOrder
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

    function insert(Order $order)
    {
        try {
            return $this->connection->exec("insert into orders
                                        (idClient, idTable, status, date) values (
                                            '" . $order->getIdClient() . "', 
                                            '" . $order->getIdTable() . "', 
                                            0, now()
                                        )");
        } catch (PDOException $ex) {
            echo $ex;
            return 0;
        }
    }

    function update(Order $order)
    {
        try {
            return $this->connection->exec(
                "update orders
                     set idClient = '" . $order->getIdClient() . "'
                         idTable = '" . $order->getIdTable() . "'
                     where id = " . $order->getId()
            );
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function delete($id)
    {
        try {
            return $this->connection->exec("delete from orders where id=" . $id);
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function select($id)
    {
        try {
            return $this->connection->query("select * from orders where id=" . $id)->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }
    
    function list()
    {
        return $this->connection->query("select * from orders", PDO::FETCH_OBJ);
    }

    function listByTable($idTable)
    {
        try {
            return $this->connection->query("select * from orders where idTable = " . $idTable . " and status = 0", PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function addItem($idOrder, $idItem)
    {
        try {
            return $this->connection->exec("insert into orderitem
                                        (idOrder, idItem) values (
                                            '" . $idOrder . "', 
                                            '" . $idItem . "'
                                        )");
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function setStatus($id){
        try {
            return $this->connection->exec("UPDATE orders SET status = 1 WHERE id = ". $id);
        } catch (PDOException $ex) {
            return 0;
        }
    }
}
