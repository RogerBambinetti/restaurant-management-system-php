<?php

require_once '../model/Administrator.php';
require_once '../model/DaoAdministrator.php';
require_once '../control/ControlAdministrator.php';
$controlAdministrator = new ControlAdministrator();
$controlAdministrator->logout();
header("Location: loginAdministrator.php");
?>
