<?php

require_once '../model/Table.php';
require_once '../model/DaoTable.php';
require_once '../control/ControlTable.php';

require_once '../model/Booking.php';
require_once '../model/DaoBooking.php';
require_once '../control/ControlBooking.php';

require_once '../model/Client.php';
require_once '../model/DaoClient.php';
require_once '../control/ControlClient.php';

require_once '../model/Item.php';
require_once '../model/DaoItem.php';
require_once '../control/ControlItem.php';

require_once '../model/OrderItem.php';
require_once '../model/DaoOrderItem.php';
require_once '../control/ControlOrderItem.php';

require_once '../model/Discount.php';
require_once '../model/DaoDiscount.php';
require_once '../control/ControlDiscount.php';

session_start();
if (!$_SESSION['emailAdministrator']) {
    header("Location: loginAdministrator.php");
}

$controlTable = new ControlTable();
$controlBooking = new ControlBooking();
$controlClient = new ControlClient();
$controlItem = new ControlItem();
$controlDiscount = new ControlDiscount();

$tables = $controlTable->list();
$clients = $controlClient->list();
$items = $controlItem->list();
$configuration = $controlDiscount->select();
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/indexAdministrator.css" />
    <meta name="theme-color" content="#262626" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>

<body id="body">

    <div id="message-error" class="message-error">
    </div>

    <div id="message-success" class="message-success">
    </div>

    <div class="menu" id="menu">
        <img src="../assets/logo.png">
        <div class="dropdown">
            <button class="dropbtn" name="modal-open-order" onclick="openModal(this.name, this.id)">Open order</button>
        </div>
        <div class="dropdown">
            <button class="dropbtn" name="modal-insert-table" onclick="openModal(this.name, this.id)">Insert table</button>
        </div>
        <div class="dropdown">
            <button class="dropbtn" name="modal-update-table" onclick="openModal(this.name, this.id)">Update table</button>
        </div>
        <div class="dropdown">
            <button class="dropbtn" name="modal-excluir-table" onclick="openModal(this.name, this.id)">Delete table</button>
        </div>
        <div class="dropdown">
            <button class="dropbtn" name="modal-insert-item" onclick="openModal(this.name, this.id)">Insert item</button>
        </div>
        <div class="dropdown">
            <button class="dropbtn" name="modal-update-item" onclick="openModal(this.name, this.id)">Update item</button>
        </div>
        <div class="dropdown">
            <button class="dropbtn" name="modal-excluir-item" onclick="openModal(this.name, this.id)">Delete item</button>
        </div>
        <div class="dropdown">
            <button class="dropbtn" name="modal-birthdays" onclick="openModal(this.name, this.id)">Birthdays</button>
        </div>
        <div class="dropdown">
            <button class="dropbtn" name="modal-discount" onclick="openModal(this.name, this.id)">Configurate</button>
        </div>
        <div class="dropdown">
            <button class="dropbtn" name="modal-user" onclick="openModal(this.name, this.id)">Profile</button>
        </div>
        <div class="dropdown">
            <a href="logoutAdministrator.php">
                <button class="dropbtn" name="modal-logout" onclick="openModal(this.name, this.id)">Logout</button>
            </a>
        </div>
        <div class="expandir">
            <a href="javascript:void(0);" class="icon" onclick="menu()">
                <i class="fa fa-bars fa-2x"></i>
            </a>
        </div>
        <div class="logout">
            <a href="logoutAdministrator.php">
                <button>
                    <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                </button>
            </a>
        </div>
        <div class="user">
            <button name="modal-user" onclick="openModal(this.name, this.id)">
                <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="modal-order" id="modal-order">
        <div class="modal-content">
            <div class="close" onclick="closeModal()">&times;</div><br>
            <div class="modal-header">
                <h2>Orders</h2>
            </div>
            <div class="modal-body">
                <form id="orders">

                </form>
            </div>
        </div>
    </div>

    <div class="modal-birthdays" id="modal-birthdays">
        <div class="modal-content">
            <div class="close" onclick="closeModal()">&times;</div><br>
            <div class="modal-header">
                <h2>Birthdays</h2>
            </div>
            <div class="modal-body">
                <form>
                    <label>Data</label><br>
                    <input type="date" name="date" id="date"><br>
                    <table>
                        <tbody id="tabelBirthdays">

                        </tbody>
                    </table>
                    <button type="button" id="listBirthdays">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-items" id="modal-items">
        <div class="modal-content">
            <div class="close" onclick="closeModal()">&times;</div><br>
            <div class="modal-header">
                <h2>Items</h2>
            </div>
            <div class="modal-body">
                <table>
                    <tbody id="tabel">

                    </tbody>
                </table>
                <div class="adicionar">
                    <div class="botao" onclick="addItem()"> <i class="fa fa-plus" aria-hidden="true"></i> </div>
                    <select id="idItem">
                        <?php foreach ($items as $i) { ?>
                            <option value="<?php echo $i->id ?>"><?php echo $i->description ?></option>
                        <?php } ?>
                    </select>
                </div>
                <form> <button type="button" id="closeOrder">Close order</button> </form>
            </div>
        </div>
    </div>

    <div class="modal-user" id="modal-user">
        <div class="modal-content">
            <div class="close" onclick="closeModal()">&times;</div><br>
            <div class="modal-header">
                <h2>Profile</h2>
            </div>
            <div class="modal-body">
                <form>
                    <label>Email</label><br>
                    <input type="text" name="" id=""><br>
                    <label>Password</label><br>
                    <input type="password" name="password" id="password"><br>
                    <label>Confirm password</label><br>
                    <input type="password" name="confirmPassword" id="confirmPassword"><br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-open-order" id="modal-open-order">
        <div class="modal-content">
            <div class="close" onclick="closeModal()">&times;</div><br>
            <div class="modal-header">
                <h2>Open order</h2>
            </div>
            <div class="modal-body">
                <form>
                    <label>Table</label><br>
                    <input type="text" name="" id="idTable"><br>
                    <label>Client</label><br>
                    <select id="idClient">
                        <?php foreach ($clients as $c) { ?>
                            <option value="<?php echo $c->id ?>"><?php echo $c->name ?> - <?php echo $c->cpf ?></option>
                        <?php } ?>
                    </select><br>
                    <button type="button" id="openOrder">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-insert-item" id="modal-insert-item">
        <div class="modal-content">
            <div class="close" onclick="closeModal()">&times;</div><br>
            <div class="modal-header">
                <h2>Insert item</h2>
            </div>
            <div class="modal-body">
                <form>
                    <label>Description</label><br>
                    <input type="text" name="" id="description"><br>
                    <label>Price</label><br>
                    <input type="number" name="" id="price"><br>
                    <label>Comments</label><br>
                    <input type="text" name="" id="comments"><br>
                    <button type="button" id="openOrder" onclick="insertItem()">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-insert-table" id="modal-insert-table">
        <div class="modal-content">
            <div class="close" onclick="closeModal()">&times;</div><br>
            <div class="modal-header">
                <h2>Insert table</h2>
            </div>
            <div class="modal-body">
                <form>
                    <label>Number</label><br>
                    <input type="number" name="" id="number"><br>
                    <label>Seats</label><br>
                    <input type="number" name="" id="seats"><br>
                    <button type="button" id="openOrder" onclick="insertTable()">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-discount" id="modal-discount">
        <div class="modal-content">
            <div class="close" onclick="closeModal()">&times;</div><br>
            <div class="modal-header">
                <h2>Configurate discounts</h2>
            </div>
            <div class="modal-body">
                <form>
                    <label>Visits number</label><br>
                    <input type="number" name="" id="visitsNumber" value="<?php echo $configuration->visitsNumber ?>"><br>
                    <label>Visits discount</label><br>
                    <input type="number" name="" id="visistsDiscount" value="<?php echo $configuration->visistsDiscount ?>"><br>
                    <label>Consumes number</label><br>
                    <input type="number" name="" id="consumesDiscount" value="<?php echo $configuration->consumesDiscount ?>"><br>
                    <label>Consumes discount</label><br>
                    <input type="number" name="" id="consumesDiscount" value="<?php echo $configuration->consumesDiscount ?>"><br>
                    <label>Birthday discount</label><br>
                    <input type="number" name="" id="discountBirthday" value="<?php echo $configuration->discountBirthday ?>"><br>
                    <button type="button" id="openOrder" onclick="updateDiscount()">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container" id="container">
        <?php foreach ($tables as $t) { ?>

            <button id="<?php echo $t->number ?>" name="modal-order" onclick="openModal(this.name, this.id)">

                <div class="table">
                    <div class="title">
                        <h2>Table <?php echo $t->number ?></h2>
                        <p><?php echo $t->seats ?> seats</p>
                    </div>
                    <div class="<?php if ($controlBooking->checkBookingToday($t->number)) {
                                    echo 'booked';
                                } else {
                                    echo 'available';
                                } ?>">
                        <h2><?php if ($controlBooking->checkBookingToday($t->number)) {
                                echo 'Booked';
                            } else {
                                echo 'Available';
                            } ?></h2>

                    </div>

                </div>

            </button>

        <?php } ?>
    </div>

</body>

</html>

<script>
    function menu() {
        var x = document.getElementById("menu");
        if (x.className === "menu") {
            x.className += " responsive";
        } else {
            x.className = "menu";
        }
    }

    var modal;
    var body = document.getElementById("body");

    function openModal(name, id) {
        fillOrders(id);
        modal = document.getElementById(name);
        modal.style.display = "block";
        body.style.overflowY = "hidden";
    }

    function closeModal() {
        modal.style.display = "none";
        body.style.overflowY = "auto";
    }

    function openItems(idOrder) {
        $.ajax({
            url: '../ajax/preenchimentoItens.php',
            dateType: 'text',
            date: {
                idOrder: idOrder
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#tabel").html(resposta);
                }
            }
        });
        modal = document.getElementById("modal-order");
        modal.style.display = "none";
        modal = document.getElementById("modal-items");
        modal.style.display = "block";
    }

    function fillOrders(id) {
        $.ajax({
            url: '../ajax/preenchimentoOrders.php',
            dateType: 'text',
            date: {
                id: id
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#orders").html(resposta);
                } else {
                    $("#orders").html("<button type='button' class='message-neutra'> Não há orders ativas para essa table </button>");
                }
            }
        });
    }

    function addItem() {
        var idItem = $("#idItem").val();
        var idOrder = $("#idOrder").val();
        $.ajax({
            url: '../ajax/adicaoItem.php',
            dateType: 'text',
            date: {
                idItem: idItem,
                idOrder: idOrder
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    openItems(idOrder);
                }
            }
        });
        openItems(idOrder);
    }

    function insertItem() {
        var description = $("#description").val();
        var price = $("#price").val();
        var comments = $("#comments").val();
        $.ajax({
            url: '../ajax/cadastroItem.php',
            dateType: 'text',
            date: {
                description: description,
                price: price,
                comments: comments
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#message-error").html(resposta);
                    $("#message-error").css("display", "block");
                    setTimeout(() => $("#message-error").css("display", "none"), 5000);
                } else {
                    $("#message-success").html("Item cadastrado com success!");
                    $("#message-success").css("display", "block");
                    setTimeout(() => location.reload(), 5000);
                }
            }
        });
    }

    function insertTable() {
        var number = $("#number").val();
        var seats = $("#seats").val();
        $.ajax({
            url: '../ajax/cadastroTable.php',
            dateType: 'text',
            date: {
                number: number,
                seats: seats
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#message-error").html(resposta);
                    $("#message-error").css("display", "block");
                    setTimeout(() => $("#message-error").css("display", "none"), 5000);
                } else {
                    $("#message-success").html("Table cadastrada com success!");
                    $("#message-success").css("display", "block");
                    setTimeout(() => location.reload(), 5000);
                }
            }
        });
    }

    function updateDiscount() {
        var visitsNumber = $("#visitsNumber").val();
        var visistsDiscount = $("#visistsDiscount").val();
        var consumesDiscount = $("#consumesDiscount").val();
        var consumesDiscount = $("#consumesDiscount").val();
        var discountBirthday = $("#discountBirthday").val();
        $.ajax({
            url: '../ajax/edicaoDiscount.php',
            dateType: 'text',
            date: {
                visitsNumber: visitsNumber,
                visistsDiscount: visistsDiscount,
                consumesDiscount: consumesDiscount,
                consumesDiscount: consumesDiscount,
                discountBirthday: discountBirthday
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#message-error").html(resposta);
                    $("#message-error").css("display", "block");
                    setTimeout(() => $("#message-error").css("display", "none"), 5000);
                } else {
                    $("#message-success").html("Configuração de discount editada com success!");
                    $("#message-success").css("display", "block");
                    setTimeout(() => location.reload(), 5000);
                }
            }
        });
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            body.style.overflowY = "auto";
        }
    }
</script>

<script>
    $("#openOrder").click(function() {
        var idTable = $("#idTable").val();
        var idClient = $("#idClient").val();
        $.ajax({
            url: '../ajax/openOrder.php',
            dateType: 'text',
            date: {
                idTable: idTable,
                idClient: idClient
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#message-error").html(resposta);
                    $("#message-error").css("display", "block");
                    setTimeout(() => $("#message-error").css("display", "none"), 5000);
                } else {
                    $("#message-success").html("Order aberta com success!");
                    $("#message-success").css("display", "block");
                    setTimeout(() => $("#message-success").css("display", "none"), 5000);
                }
            }
        });
    });


    $("#closeOrder").click(function() {
        var idOrder = $("#idOrder").val();
        $.ajax({
            url: '../ajax/closeOrder.php',
            dateType: 'text',
            date: {
                idOrder: idOrder
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    alert("Valor total: R$ " + resposta);
                }
                $("#message-success").html("Order fechada com success!");
                $("#message-success").css("display", "block");
                setTimeout(() => $("#message-success").css("display", "none"), 5000);
                setTimeout(() => location.reload(), 5000);
            }
        });
    });

    $("#listBirthdays").click(function() {
        var date = $("#date").val();
        $.ajax({
            url: '../ajax/listBirthdays.php',
            dateType: 'text',
            date: {
                date: date
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#tabelBirthdays").html(resposta);
                }
            }
        });
    });
</script>