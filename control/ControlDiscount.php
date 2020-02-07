<?php

class ControlDiscount
{

    private $discount;
    private $dao;
    private $erros;

    function __construct()
    {
        $this->discount = new Discount();
        $this->dao = new DaoDiscount();
        $this->erros = array();
    }

    function update($visitsNumber, $visitsDiscount, $consumesNumber, $consumesDiscount, $birthdayDiscount, $id)
    {
        if (!strlen($visitsNumber)) {
            $this->erros[] = "Missing visits number";
        }
        if (!strlen($visitsDiscount)) {
            $this->erros[] = "Missing visits discount";
        }
        if (!strlen($consumesNumber)) {
            $this->erros[] = "Missing consumes number";
        }
        if (!strlen($consumesDiscount)) {
            $this->erros[] = "Missing consumes discount";
        }
        if (!strlen($birthdayDiscount)) {
            $this->erros[] = "Missing birthday discount";
        }

        if (!$this->erros) {
            $this->discount = new Discount($visitsNumber, $visitsDiscount, $consumesNumber, $consumesDiscount, $birthdayDiscount, $id);
            $this->dao->update($this->discount);
        }
    }

    function select()
    {
        return $this->dao->select();
    }

    function list()
    {
        return $this->dao->list();
    }

    function giveDiscount(Client $client, $consumes)
    {
        $discount = $this->dao->select();
        $today = new DateTime();
        $birthday = new DateTime($client->getBirthday());
        if (date_format($birthday, 'm-d') == date_format($today, 'm-d')) {
            return $consumes - (($consumes * $discount->birthdayDiscount) / 100);
        } else if ($consumes >= $discount->consumesNumber) {
            return $consumes - (($consumes * $discount->consumesDiscount) / 100);
        } else if ($client->getVisits() >= $discount->visitsNumber) {
            $controlClient = new ControlClient();
            $controlClient->setVisits($client, $client->getVisits, $discount->visitsNumber);
            return $consumes - (($consumes * $discount->visitsDiscount) / 100);
        } else {
            return $consumes;
        }
    }

    function getErrors()
    {
        return $this->errors;
    }
}
