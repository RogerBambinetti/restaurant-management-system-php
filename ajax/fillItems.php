<?php
require_once '../model/Item.php';
require_once '../model/DaoItem.php';
require_once '../control/ControlItem.php';

require_once '../model/OrderItem.php';
require_once '../model/DaoOrderItem.php';
require_once '../control/ControlOrderItem.php';

$controlItem = new ControlItem();
$controlOrderItem = new ControlOrderItem();

$consumedItems = $controlOrderItem->listByOrder($_POST['idOrder']);

if ($controlOrderItem->listByOrder($_POST['idOrder'])) {
    ?>
    <tr>
        <th>Item</th>
        <th>Number</th>
        <th>Price</th>
    </tr>
    <?php foreach ($consumedItems as $i) {
            $item = $controlItem->select($i->idItem);
            ?>
        <tr>
            <td><?php echo $item->description ?></td>
            <td><?php echo $i->number ?></td>
            <td>R$: <?php echo $i->number * $item->valor ?></td>
            </td>
        </tr>
    <?php } ?>
    <input type="hidden" id="idOrder" value="<?php echo $_POST['idOrder'] ?>" />
<?php }
unset($_POST);
