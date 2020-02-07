<?php

require_once '../model/Client.php';
require_once '../model/DaoClient.php';
require_once '../control/ControlClient.php';

require_once '../model/Table.php';
require_once '../model/DaoTable.php';
require_once '../control/ControlTable.php';

require_once '../model/Booking.php';
require_once '../model/DaoBooking.php';
require_once '../control/ControlBooking.php';

session_start();
if (!$_SESSION['email']) {
    header("Location: loginClient.php");
}

$controlClient = new ControlClient();
$controlTable = new ControlTable();
$controlBooking = new ControlBooking();

$client = $controlClient->checkEmail($_SESSION['email']);
$tables = $controlTable->list();
$bookings = $controlBooking->listByClient($client->id);

?>

<!DOCTYPE html>
<html>

<head>

    <title></title>

    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/indexClient.css" />

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
            <button class="dropbtn" name="modal-booking" onclick="openModal(this.name, this.id)">Booking</button>
        </div>

        <div class="dropdown">
            <button class="dropbtn" name="modal-bookings" onclick="openModal(this.name, this.id)">Cancel booking</button>
        </div>

        <div class="dropdown">
            <button class="dropbtn" name="modal-user" onclick="openModal(this.name, this.id)">Profile</button>
        </div>

        <div class="dropdown">
            <a href="logoutClient.php">
                <button class="dropbtn" name="modal-logout" onclick="openModal(this.name, this.id)">Logout</button>
            </a>
        </div>

        <div class="expandir">
            <a href="javascript:void(0);" class="icon" onclick="menu()">
                <i class="fa fa-bars fa-2x"></i>
            </a>
        </div>

        <div class="logout">
            <a href="logoutClient.php">
                <button>
                    <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                </button></a>
        </div>

        <div class="user">
            <button name="modal-user" onclick="openModal(this.name, this.id)">
                <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
            </button>
        </div>

    </div>

    <div class="modal-booking" id="modal-booking">

        <div class="modal-content">

            <div class="close" onclick="closeModal()">&times;</div><br>

            <div class="modal-header">
                <h2>Booking</h2>
            </div>

            <div class="modal-body">
                <form>

                    <label>Table</label><br>
                    <input type="number" name="" id="number"><br>

                    <label>Time</label><br>
                    <input type="datetime-local" name="" id="time"><br>

                    <input type="hidden" id="idClient" value="<?php echo $client->id ?>">

                    <button type="button" id="bookTable">Submit</button>

                </form>
            </div>

        </div>

    </div>

    <div class="modal-user" id="modal-user">

        <div class="modal-content">

            <div class="close" onclick="closeModal()">&times;</div><br>

            <div class="modal-header">
                <h2>Update profile</h2>
            </div>

            <div class="modal-body">
                <form>
                    <input type="hidden" id="id" value="<?php echo $client->id; ?>">
                    <label>CPF</label><br>
                    <input type="text" name="cpf" id="cpf" value="<?php echo $client->cpf; ?>"><br>

                    <label>Name</label><br>
                    <input type="text" name="name" id="name" value="<?php echo $client->name; ?>"><br>

                    <label>Birthday</label><br>
                    <input type="date" name="birthday" id="birthday" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $client->birthday; ?>"><br>

                    <label>Address</label><br>
                    <input type="text" name="address" id="address" value="<?php echo $client->address; ?>"><br>

                    <label>E-mail</label><br>
                    <input type="text" name="email" id="email" value="<?php echo $client->email; ?>"><br>

                    <label>Password</label><br>
                    <input type="password" name="password" id="password"><br>

                    <label>Confirm password</label><br>
                    <input type="password" name="confirmPassword" id="confirmPassword"><br>

                    <button id="updateClient">Submit</button>

                </form>
            </div>
        </div>
    </div>

    <div class="modal-bookings" id="modal-bookings">
        <div class="modal-content">
            <div class="close" onclick="closeModal()">&times;</div><br>
            <div class="modal-header">
                <h2>Bookings</h2>
            </div>
            <div class="modal-body">
                <form>
                    <?php if ($bookings) {
                        foreach ($bookings as $r) { ?>
                            <button type="button" id="<?php echo $r->id ?>" onclick="confirmarCancelamento(this.id)">Table <?php echo $r->idTable ?> - <?php $time = new DateTime($r->time);
                                                                                                                                                                echo $time->format("d/m/Y H:i") ?></button>
                    <?php }
                    } else { } ?>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-confirm-cancel" id="modal-confirm-cancel">
        <div class="modal-content">
            <div class="close" onclick="closeModal()">&times;</div><br>
            <div class="modal-header">
                <h2>Cancel booking</h2>
            </div>
            <div class="modal-body">
                <form>
                    <label>Do you want to cancel this booking?</label>
                    <br>
                    <br>
                    <input id="idBooking" type="hidden">
                    <button type="button" onclick="deleteBooking()">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container" id="container">

        <?php foreach ($tables as $m) { ?>

            <button id="<?php echo $m->number ?>" name="modal-booking" onclick="openModal(this.name, this.id)">

                <div class="table">
                    <div class="title">
                        <h2>Table <?php echo $m->number ?></h2>
                        <p><?php echo $m->seats ?> seats</p>
                    </div>
                    <div class="<?php if ($controlBooking->checkBookingToday($m->number)) {
                                        echo 'booked';
                                    } else {
                                        echo 'available';
                                    } ?>">
                        <h2><?php if ($controlBooking->checkBookingToday($m->number)) {
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
        document.getElementById("number").value = id;
        modal = document.getElementById(name);
        modal.style.display = "block";
        body.style.overflowY = "hidden";
    }

    function closeModal() {
        modal.style.display = "none";
        body.style.overflowY = "auto";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            body.style.overflowY = "auto";
        }
    }
</script>

<script>

    function confirmarCancelamento(idBooking) {
        closeModal();
        modal = document.getElementById("modal-confirm-cancel");
        modal.style.display = "block";
        body.style.overflowY = "hidden";
        document.getElementById("idBooking").value = idBooking;
    }

    function deleteBooking() {
        idBooking = document.getElementById("idBooking").value;
        $.ajax({
            url: '../ajax/deleteBooking.php',
            dataType: 'text',
            data: {
                idBooking: idBooking,
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#message-error").html(resposta);
                    $("#message-error").css("display", "block");
                    setTimeout(() => $("#message-error").css("display", "none"), 5000);
                } else {
                    $("#message-success").html("Canceled!");
                    $("#message-success").css("display", "block");
                    setTimeout(() => $("#message-success").css("display", "none"), 5000);
                    setTimeout(() => location.reload(), 5000);
                }
            }

        });

    }

    $("#updateClient").click(function() {
        var cpf = $("#cpf").val();
        var name = $("#name").val();
        var birthday = $("#birthday").val();
        var address = $("#address").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();
        var id = $("#id").val();
        $.ajax({
            url: '../ajax/updateClient.php',
            dataType: 'text',
            data: {
                cpf: cpf,
                name: name,
                birthday: birthday,
                address: address,
                email: email,
                password: password,
                confirmPassword: confirmPassword,
                id: id
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#message-error").html(resposta);
                    $("#message-error").css("display", "block");
                    setTimeout(() => $("#message-error").css("display", "none"), 5000);
                } else {
                    $("#message-success").html("Updated!");
                    $("#message-success").css("display", "block");
                    setTimeout(() => $("#message-success").css("display", "none"), 5000);
                }
            }

        });
        return false;
    });
</script>

<script>

    $("#bookTable").click(function() {
        var time = $("#time").val();
        var number = $("#number").val();
        var idClient = $("#idClient").val();
        $.ajax({
            url: '../ajax/bookTable.php',
            dataType: 'text',
            data: {
                time: time,
                number: number,
                idClient: idClient
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#message-error").html(resposta);
                    $("#message-error").css("display", "block");
                    setTimeout(() => $("#message-error").css("display", "none"), 5000);
                } else {
                    $("#message-success").html("Booked!");
                    $("#message-success").css("display", "block");
                    setTimeout(() => $("#message-success").css("display", "none"), 5000);
                    setTimeout(() => location.reload(), 5000);
                }
            }
        });
    });
</script>