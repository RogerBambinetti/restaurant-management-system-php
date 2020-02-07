<?php

require_once '../control/ControlOrder.php';
require_once '../control/ControlBooking.php';
require_once '../model/DaoOrder.php';
require_once '../model/DaoBooking.php';
require_once '../model/Order.php';
require_once '../model/Booking.php';

$controlOrder = new ControlOrder();

if ($controlOrder->openOrder($_POST['idClient'], $_POST['idTable'])) {
    unset($_POST);
} else {
    $errors = "";
    foreach ($controlOrder->getErrors() as $e) {
        $errors = $errors . $e . '</br>';
    }
    echo $errors;
}
