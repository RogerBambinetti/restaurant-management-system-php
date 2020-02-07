<?php

require_once '../control/ControlBooking.php';
require_once '../model/DaoBooking.php';
require_once '../model/Booking.php';

$controlBooking = new ControlBooking();

if ($controlBooking->insert($_POST['time'], $_POST['number'], $_POST['idClient'])) {
    unset($_POST);
} else {
    $errors = "";
    foreach ($controlBooking->getErrors() as $e) {
        $errors = $errors . $e . "<br>";
    }
    echo $errors;
}
