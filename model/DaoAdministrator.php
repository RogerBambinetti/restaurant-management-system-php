<?php 
class DaoAdministrator{
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

    function insert(Administrator $administrator){
        try {
            return $this->connection->exec("insert into administrators
                                        (email, password) values (
                                            '".$administrator->getEmail()."', 
                                            '".$administrator->getPassword()."'
                                        )");
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function update(Administrator $administrator){
        try {
            return $this->connection->exec(
                    "update administrators
                     set email = '".$administrator->getEmail()."',
                        password = '".$administrator->getPassword()."'
                     where id = ". $administrator->getId());
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function delete($id){
        try {
            return $this->connection->exec("delete from administrators where id=".$id);
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function select($id){
        try {
            return $this->connection->query("select * from administrators where id=".$id)->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function list(){
        return $this->connection->query("select * from administrators", PDO::FETCH_OBJ);
    }

    function checkEmail(Administrator $administrator) {
        try {
            return $this->connection->query("select * from administrators where email = '" . $administrator->getEmail() . "'")->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function login(Administrator $administrator) {
        try {
            return $this->connection->query("select * from administrators where email = '" . $administrator->getEmail() . "' and password = '" . $administrator->getPassword() . "'")->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }
    
}
?>