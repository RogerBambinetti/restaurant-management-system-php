<?php

class ControlOrderItem
{

    private $orderItem;
    private $dao;
    private $errors;

    function __construct()
    {
        $this->orderItem = new OrderItem(0, 0, 0);
        $this->dao = new DaoOrderItem();
        $this->errors = array();
    }

    function list()
    {
        return $this->dao->list();
    }

    function listByOrder($idOrder)
    {
        return $this->dao->listByOrder($idOrder);
    }

    function select($idItem, $idOrder)
    {
        return $this->dao->select($idItem, $idOrder);
    }

    function delete($idItem, $idOrder)
    {
        return $this->dao->delete($idItem, $idOrder);
    }

    function insert($idOrder, $idItem)
    {
        if (!strlen($idOrder)) {
            $this->errors[] = "Missing order";
        }
        if (!strlen($idItem)) {
            $this->errors[] = "Missing item";
        }

        if (!$this->errors) {
            $this->orderItem = new OrderItem($idOrder, $idItem, 1);
            if ($this->dao->select($idItem, $idOrder)) {
                return $this->countItem($idOrder, $idItem);
            } else {
                return $this->dao->insert($this->orderItem);
            }
        } else {
            return false;
        }
    }

    function countItem($idOrder, $idItem)
    {
        $aux = $this->dao->select($idItem, $idOrder);
        $this->orderItem = new OrderItem($aux->idOrder, $aux->idItem, ($aux->quantidade + 1));
        return $this->dao->update($this->orderItem);
    }

    function calculatePrice($idOrder)
    {
        return $this->dao->calculatePrice($idOrder);
    }

    function getErrors()
    {
        return $this->errors;
    }
}
