<?php

require_once '../model/Table.php';
require_once '../model/DaoTable.php';
require_once '../control/ControlTable.php';

$controlTable = new ControlTable();

if ($controlTable->insert(
    $_POST['number'],
    $_POST['seats']
)) {
    unset($_POST);
} else {
    $errors = "";
    foreach ($controlTable->getErrors() as $e) {
        $errors = $errors . $e . "<br>";
    }
    echo $errors;
}
