<?php

require_once '../model/OrderItem.php';
require_once '../model/DaoOrderItem.php';
require_once '../control/ControlOrderItem.php';

$controlOrderItem = new ControlOrderItem();

if ($controlOrderItem->insert($_POST['idOrder'], $_POST['idItem'])) {
    unset($_POST);
    return true;
}else{
    return false;
}
