<?php

require_once '../model/Item.php';
require_once '../model/DaoItem.php';
require_once '../control/ControlItem.php';

$controlClient = new ControlClient();

if ($controlItem->update(
    $_POST['description'],
    $_POST['price'],
    $_POST['comments'],
    $_POST['id']
)) {
    unset($_POST);
} else {
    $erros = "";
    foreach ($controlItem->getErros() as $e) {
        $erros = $erros . $e . "<br>";
    }
    echo $erros;
}
