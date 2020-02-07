<?php
require_once '../model/Client.php';
require_once '../model/DaoClient.php';
require_once '../control/ControlClient.php';

$controlClient = new ControlClient();

if ($controlClient->login(addslashes($_POST['email']), addslashes($_POST['password']))) {
    session_start();
    $_SESSION['email'] = $_POST['email'];
} else {
    $errors = "";
    foreach ($controlClient->getErrors() as $e) {
        $errors = $errors . $e . "<br>";
    }
    echo $errors;
}
