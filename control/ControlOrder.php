<?php

class ControlOrder
{

    private $order;
    private $dao;
    private $errors;

    function __construct()
    {
        $this->order = new Order();
        $this->dao = new DaoOrder();
        $this->errors = array();
    }

    function insert($idClient, $idTable)
    {
        if (!strlen($idClient)) {
            $this->errors[] = "Missing client";
        }
        if (!strlen($idTable)) {
            $this->errors[] = "Missing table";
        }

        if (!$this->errors) {
            $this->order = new Order(0, $idClient, $idTable, 0);
            return $this->dao->insert($this->order);
        } else {
            return 0;
        }
    }

    function update($idClient, $idTable, $id)
    {
        if (!strlen($idClient)) {
            $this->errors[] = "Missing client";
        }
        if (!strlen($idTable)) {
            $this->errors[] = "Missing table";
        }

        if (!$this->errors) {
            $this->order = new Order(0, $idClient, $idTable, $id);
            return $this->dao->update($this->order);
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

    function list()
    {
        return $this->dao->list();
    }

    function listByTable($idTable)
    {
        return $this->dao->listByTable($idTable);
    }

    function openOrder($idClient, $idTable)
    {
        if (!strlen($idClient)) {
            $this->errors[] = "Missing client";
        }
        if (!strlen($idTable)) {
            $this->errors[] = "Missing table";
        }
        $controlBooking = new ControlBooking();
        if ($controlBooking->checkBookingToday($idTable)) {
            $bookingToday = $controlBooking->checkBookingToday($idTable);
            if ($bookingToday->idClient != $idClient) {
                $this->errors[] = "The booking was not from this client";
            } else {
                // A mesa foi reservada por esse client
            }
        } else {
            // não existe uma reserva hoje
        }

        if (!$this->errors) {
            $this->order = new Order(0, $idClient, $idTable, 0);
            return $this->dao->insert($this->order);
        } else {
            return 0;
        }
    }

    function addItem($idOrder, $idItem)
    {
        if (!strlen($idOrder)) {
            $this->errors[] = "Missing order";
        }
        if (!strlen($idItem)) {
            $this->errors[] = "Missing item";
        }

        if (!$this->errors) {
            return $this->dao->addItem($idOrder, $idItem);
        } else {
            return 0;
        }
    }

    function closeOrder($id)
    {
        $controlOrderItem = new ControlOrderItem();
        $controlDiscount = new ControlDiscount();
        $controlClient = new ControlClient();
        $controlBooking =  new ControlBooking();
        $this->order = $this->dao->select($id);
        $client = $controlClient->select($this->order->idClient);
        $controlClient->countVisit($client->id);
        $client = new Client(
            $client->cpf,
            $client->nome,
            $client->nascimento,
            $client->endereco,
            $client->email,
            $client->senha,
            $client->id,
            $client->visitas
        );
        $val = $controlOrderItem->calculatePrice($id);
        $val = $controlDiscount->giveDiscount($client, $val);
        $this->dao->setStatus($id); 
        if($controlBooking->selectByTable($this->order->idTable)){
                $booking = $controlBooking->selectByTable($this->order->idTable);
                $controlBooking->closeBooking($booking->id);
        }
        return $val;
    }

    function getErrors()
    {
        return $this->errors;
    }
}
