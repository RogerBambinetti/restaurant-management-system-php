<?php

require_once '../model/Client.php';
require_once '../model/DaoClient.php';
require_once '../control/ControlClient.php';
$controlClient = new ControlClient();
$controlClient->logout();
header("Location: loginClient.php");
?>
