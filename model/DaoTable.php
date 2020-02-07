<?php
class DaoTable
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

    function insert(Table $table)
    {
        try {
            return $this->connection->exec("insert into tables
                                        (number, seats) values (
                                            " . $table->getNumber() . ", 
                                            " . $table->getSeats() . "
                                        )");
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function update(Table $table)
    {
        try {
            return $this->connection->exec("UPDATE tables
                                        SET number = " . $table->getNumber() . ",
                                            seats = " . $table->getSeats() . "
                                        WHERE id = " . $table->getId());
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function delete($id)
    {
        try {
            return $this->connection->exec("delete from tables where id=" . $id);
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function select($id)
    {
        try {
            return $this->connection->query("select * from tables where id=" . $id)->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function selectByNumber($number)
    {
        try {
            return $this->connection->query("SELECT * FROM tables WHERE number = ".$number)->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function list()
    {
        return $this->connection->query("select * from tables", PDO::FETCH_OBJ);
    }
}
