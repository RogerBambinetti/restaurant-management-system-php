<?php
require_once '../model/Client.php';
require_once '../model/DaoClient.php';
require_once '../control/ControlClient.php';

$controlClient = new ControlClient();

if ($controlClient->update(
    $_POST['cpf'],
    $_POST['name'],
    $_POST['birthday'],
    $_POST['address'],
    $_POST['email'],
    $_POST['password'],
    $_POST['confirmPassword'],
    $_POST['id']
)) {
    unset($_POST);
} else {
    $errors = "";
    foreach ($controlClient->getErrors() as $e) {
        $errors = $errors . $e . "<br>";
    }
    echo $errors;
}
