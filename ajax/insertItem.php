<?php

require_once '../model/Item.php';
require_once '../model/DaoItem.php';
require_once '../control/ControlItem.php';

$controlItem = new ControlItem();

if ($controlItem->insert(
    $_POST['description'],
    $_POST['price'],
    $_POST['comments']
)) {
    unset($_POST);
} else {
    $errors = "";
    foreach ($controlItem->getErrors() as $e) {
        $errors = $errors . $e . "<br>";
    }
    echo $errors;
}
