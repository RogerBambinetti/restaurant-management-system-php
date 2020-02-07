<?php

require_once '../model/Booking.php';
require_once '../model/DaoBooking.php';
require_once '../control/ControlBooking.php';

$controlBooking = new ControlBooking();

if ($controlBooking->delete($_POST['idBooking'])) {
    unset($_POST);
} else {
    $errors = "";
    foreach ($controlBooking->getErrors() as $e) {
        $errors = $errors . $e . "<br>";
    }
    echo $errors;
}
