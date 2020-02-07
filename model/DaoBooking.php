<?php
class DaoBooking
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

    function insert(Booking $booking)
    {
        try {
            return $this->connection->exec("insert into bookings
                                        (status, time, idTable, idClient) values (
                                            " . $booking->getStatus() . ", 
                                            '" . date_format($booking->getTime(), 'Y-m-d H:i:s') . "',
                                            " . $booking->getIdTable() . ",
                                            " . $booking->getIdClient() . "

                                        )");
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function update(Booking $booking)
    {
        try {
            return $this->connection->exec("UPDATE bookings
                                        SET status = " . $booking->getStatus() . ",
                                            time = '" . $booking->getTime() . "',
                                            idTable = " . $booking->getidTable() . ",
                                            idClient = " . $booking->getidClient() . "
                                        WHERE id = " . $booking->getId());
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return 0;
        }
    }

    function delete($id)
    {
        try {
            return $this->connection->exec("delete from bookings where id=" . $id);
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function select($id)
    {
        try {
            return $this->connection->query("select * from bookings where id=" . $id)->fetchObject();
        } catch (PDOException $ex) {
            return 0;
        }
    }

    function selectByDate(Booking $booking)
    {
        $data = date_format($booking->getTime(), 'Y-m-d');
        try {
            return $this->connection->query("SELECT *
                                        FROM bookings
                                        WHERE idTable = " . $booking->getIdTable() . " 
                                        AND time like '" . $data . "%'
                                ")->fetchObject();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return 0;
        }
    }

    function selectByActiveDate(Booking $booking)
    {
        $data = date_format($booking->getTime(), 'Y-m-d');
        try {
            return $this->connection->query("SELECT *
                                        FROM bookings
                                        WHERE idTable = " . $booking->getIdTable() . " 
                                        AND status = 0
                                        AND time like '" . $data . "%'
                                ")->fetchObject();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return 0;
        }
    }

    function SelectByTable($idTable)
    {
        try {
            return $this->connection->query("SELECT *
                                        FROM bookings
                                        WHERE status = 0 AND 
                                        idTable = " . $idTable)->fetchObject();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return 0;
        }
    }

    function list()
    {
        return $this->connection->query("select * from bookings", PDO::FETCH_OBJ);
    }

    function listByClient($idClient)
    {
        return $this->connection->query("select * from bookings where status = 0 and idClient = " . $idClient, PDO::FETCH_OBJ);
    }

    function closeBooking($id)
    {
        try {
            return $this->connection->exec("UPDATE bookings
                                        SET status = 1 
                                        WHERE id = " . $id);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return 0;
        }
    }
}
