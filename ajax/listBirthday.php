<?php

require_once '../model/Client.php';
require_once '../model/DaoClient.php';
require_once '../control/ControlClient.php';

$controlClient = new ControlClient();

$birthdays = $controlClient->listBirthdays($_POST['date']);
?>
<tr>
    <th>Name:</th>
    <th>e-mail:</th>
</tr>
<?php
foreach ($birthdays as $b) { ?>
    <tr>
        <td><?php echo $b->name ?></td>
        <td><?php echo $b->email ?></td>
    </tr>
<?php }
unset($_POST);
