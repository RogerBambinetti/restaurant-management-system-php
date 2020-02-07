<?php
require_once '../model/Order.php';
require_once '../model/DaoOrder.php';
require_once '../control/ControlOrder.php';

require_once '../model/Table.php';
require_once '../model/DaoTable.php';
require_once '../control/ControlTable.php';

$controlOrder = new ControlOrder();
$controlTable = new ControlTable();
$table = $controlTable->selectByNumber($_POST['id']);
$orders = $controlOrder->listByTable($table->id);

$counter=1;
if ($controlTable->selectByNumber($_POST['id'])) {
    unset($_POST);
    foreach ($orders as $o) { ?>
        <button type="button" onclick="openItems(<?php echo $o->id?>)">Order <?php echo $counter; $counter++?></button>
<?php }
}
?>