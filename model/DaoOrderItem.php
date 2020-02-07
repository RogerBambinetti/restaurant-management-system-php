<?php

class DaoOrderItem
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

    function insert(OrderItem $orderitem)
    {
        try {
            return $this->connection->exec("insert into orderitem
                                        (idOrder, idItem, number) values (
                                            " . $orderitem->getIdOrder() . ", 
                                            " . $orderitem->getIdItem() . ",
                                            ".$orderitem->getNumber()."
                                        )");
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function update(OrderItem $orderitem){
        try {
            return $this->connection->exec("UPDATE orderitem
                                        SET number = ".$orderitem->getNumber()."
                                        WHERE idOrder = ".$orderitem->getIdOrder()." AND
                                            idItem = ".$orderitem->getIdItem()."
                                        ");
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function delete($idItem, $idOrder)
    {
        try {
            return $this->connection->exec("delete from orderitem where idItem=" . $idItem . " and idOrder = " . $idOrder);
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function select($idItem, $idOrder)
    {
        try {
            return $this->connection->query("select * from orderitem where idItem=" . $idItem . " and idOrder = " . $idOrder)->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function list()
    {
        return $this->connection->query("select * from orderitem", PDO::FETCH_OBJ);
    }

    function listByOrder($idOrder)
    {
        return $this->connection->query("select * from orderitem where idOrder = " . $idOrder, PDO::FETCH_OBJ);
    }

    function calculatePrice($idOrder)
    {
        try {
            return $this->connection->query("SELECT sum(ci.number*i.price) as price
                                    FROM orderitem ci
                                        JOIN item i ON i.id = ci.idItem
                                    WHERE ci.idOrder = " . $idOrder . "
                                    GROUP BY ci.idOrder
                                 ")->fetchColumn();
        } catch (PDOException $ex) {
            return 0;
        }
    }

}
