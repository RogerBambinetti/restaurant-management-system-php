<?php
require_once '../model/Administrator.php';
require_once '../model/DaoAdministrator.php';
require_once '../control/ControlAdministrator.php';

$controlAdministrator = new ControlAdministrator();

if ($controlAdministrator->login(addslashes($_POST['email']), addslashes($_POST['password']))) {
    session_start();
    $_SESSION['emailAdministrator'] = $_POST['email'];
} else {
    $errors = "";
    foreach ($controlAdministrator->getErrors() as $e) {
        $errors = $errors . $e . "<br>";
    }
    echo $errors;
}
