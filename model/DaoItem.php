<?php
class DaoItem
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

    function insert(Item $item)
    {
        try {
            return $this->connection->exec("insert into items
                                        (description, price, comments) values (
                                            '" . $item->getDescription() . "', 
                                            " . $item->getPrice() . ",
                                            '" . $item->getComments() . "'
                                        )");
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function update(Item $item)
    {
        try {
            return $this->connection->exec("update items
                                        set description = '" . $item->getDescription() . "',
                                            price = " . $item->getPrice() . ".
                                            comments = '" . $item->getComments() . "'
                                        where id = " . $item->getId());
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function delete($id)
    {
        try {
            return $this->connection->exec("delete from items where id=" . $id);
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function select($id)
    {
        try {
            return $this->connection->query("select * from items where id=" . $id)->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }

    
    function list()
    {
        return $this->connection->query("select * from items", PDO::FETCH_OBJ);
    }
}
