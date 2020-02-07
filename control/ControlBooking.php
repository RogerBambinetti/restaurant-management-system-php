<?php

class ControlBooking
{

    private $dao;
    private $booking;
    private $errors;

    function __construct()
    {
        $this->dao = new DaoBooking();
        $this->booking = new Booking();
        $this->errors = array();
    }

    function insert($time, $idTable, $idClient)
    {
        if (!strlen($time)) {
            $this->errors[] = "Missing time";
        }

        if (!strlen($idTable)) {
            $this->errors[] = "Missing table";
        }

        if (!strlen($idClient)) {
            $this->errors[] = "Missing client";
        }
        if (!$this->errors) {

            $timeBooking = new DateTime($time);
            if ($timeBooking < new DateTime()) {
                $this->errors[] = "It is impossible to go back in time";
            } else if ((date_format($timeBooking, 'H') < 18) || (date_format($timeBooking, 'H') > 21)) {
                $this->errors[] = "Time needs to be between 18h and 22h";
            }
            $this->booking = new Booking(0, $timeBooking, $idTable, $idClient, 0);
            if ($this->dao->selectByActiveDate($this->booking)) {
                $this->errors[] = "There's already a booking for this table in this date";
            }

            if (!$this->errors) {
                $this->booking = new Booking(0, $timeBooking, $idTable, $idClient, 0);
                return $this->dao->insert($this->booking);
            } else {
                return 0;
            }
        }
    }

    function update($time, $idTable, $idClient, $idBooking)
    {

        if (!strlen($time)) {
            $this->errors[] = "Missing time";
        }

        if (!strlen($idTable)) {
            $this->errors[] = "Missing table";
        }

        if (!strlen($idClient)) {
            $this->errors[] = "Missing client";
        }

        if (!strlen($idBooking)) {
            $this->errors[] = "Missing booking";
        }

        if (!$this->errors) {
            $this->booking = new Booking(0, $time, $idTable, $idClient, $idBooking);
            return $this->dao->insert($this->booking);
        } else {
            return 0;
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

    function selectByTable($idTable)
    {
        return $this->dao->selectByTable($idTable);
    }

    function list()
    {
        return $this->dao->list();
    }

    function listbyClient($idClient)
    {
        return $this->dao->listbyClient($idClient);
    }

    function isAvailable($idTable, $time)
    {
        $this->booking = new Booking(0, $time, $idTable, 0, 0);
        if ($this->dao->selectByDate($this->booking)) {
            return false;
        } else {
            return true;
        }
    }

    function checkBookingToday($idTable)
    {
        $timeBooking = new DateTime();
        $this->booking = new Booking(0, $timeBooking, $idTable, 0, 0);
        return $this->dao->selectByActiveDate($this->booking);
    }

    function closeBooking($id)
    {
        return $this->dao->closeBooking($id);
    }

    function getErrors()
    {
        return $this->errors;
    }
}
