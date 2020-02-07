<?php 
class DaoDiscount{
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

    function update(Discount $discount){
        try {
            return $this->connection->exec(
                    "update discounts
                     set visitsNumber = ".$discount->getVisitsNumber().",
                         visitsDiscount = ".$discount->getVisitsDiscount().",
                         consumesNumber = ".$discount->getConsumesNumber().",
                         consumesDiscount = ".$discount->getConsumesDiscount().",
                         birthdayDiscount = ".$discount->getBirthdayDiscount()."
                     where id = 1");
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function select(){
        try {
            return $this->connection->query("select * from discounts where id = 1")->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    } 

    function list(){
        return $this->connection->query("select * from discounts", PDO::FETCH_OBJ);
    }
}
