<?php

require_once '../control/ControlDiscount.php';
require_once '../model/Discount.php';
require_once '../model/DaoDiscount.php';

$controlDiscount = new ControlDiscount();

if ($controlDiscount->update(
    $_POST['visitsNumber'],
    $_POST['visitsDiscount'],
    $_POST['consumesNumber'],
    $_POST['consumesDiscount'],
    $_POST['birthdayDiscount'],
    1
)) {
    unset($_POST);
} else {
    $errors = "";
    foreach ($controlDiscount->getErrors() as $e) {
        $errors = $errors . $e . "<br>";
    }
    echo $errors;
}