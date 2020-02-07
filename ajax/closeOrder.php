<?php

require_once '../control/ControlOrder.php';
require_once '../model/DaoOrder.php';
require_once '../model/Order.php';

require_once '../model/OrderItem.php';
require_once '../model/DaoOrderItem.php';
require_once '../control/ControlOrderItem.php';

require_once '../model/Discount.php';
require_once '../model/DaoDiscount.php';
require_once '../control/ControlDiscount.php';

require_once '../model/Client.php';
require_once '../model/DaoClient.php';
require_once '../control/ControlClient.php';

require_once '../model/Booking.php';
require_once '../model/DaoBooking.php';
require_once '../control/ControlBooking.php';

$controlOrder = new ControlOrder();

if ($controlOrder->closeOrder($_POST['idOrder'])) {
    echo $controlOrder->closeOrder($_POST['idOrder']);
    unset($_POST);
} else {
    $errors = "";
    foreach ($controlOrder->getErrors() as $e) {
        $errors = $errors . $e . '</br>';
    }
    echo $errors;
}
