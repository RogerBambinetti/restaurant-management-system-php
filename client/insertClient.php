<!DOCTYPE html>

<html>

<head>
    <title></title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/insertClient.css" />

    <meta name="theme-color" content="#262626" />
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="../js/mascaras.js"></script>

</head>

<body>
    <div id="message-error" class="message-error">
    </div>
    <div id="message-success" class="message-success">
    </div>
    <div class="container" id="container">
        <div class="insert">
            <div class="titulo">
                <h2>Sign up</h2>
            </div>
            <form>
                <label>CPF</label><br>
                <input type="text" name="cpf" id="cpf" value="<?php if (isset($_POST["cpf"])) {
                                                                    echo $_POST["cpf"];
                                                                } ?>"><br>

                <label>Name</label><br>
                <input type="text" name="name" id="name" value="<?php if (isset($_POST["cpf"])) {
                                                                    echo $_POST["name"];
                                                                } ?>"><br>

                <label>Birthday</label><br>
                <input type="date" name="birthday" id="birthday" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value=""><br>

                <label>Address</label><br>
                <input type="text" name="address" id="address" value="<?php if (isset($_POST["cpf"])) {
                                                                            echo $_POST["address"];
                                                                        } ?>"><br>

                <label>E-mail</label><br>
                <input type="text" name="email" id="email" value="<?php if (isset($_POST["cpf"])) {
                                                                        echo $_POST["email"];
                                                                    } ?>"><br>

                <label>Password</label><br>
                <input type="password" name="password" id="password"><br>

                <label>Confirm password</label><br>
                <input type="password" name="confirmPassword" id="confirmPassword"><br>

                <button id="insertClient" type="submit">Submit</button>

            </form>
        </div>
    </div>
</body>

<script>
    $("#insertClient").click(function() {
        var cpf = $("#cpf").val();
        var name = $("#name").val();
        var birthday = $("#birthday").val();
        var address = $("#address").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();
        $.ajax({
            url: '../ajax/insertClient.php',
            dataType: 'text',
            data: {
                cpf: cpf,
                name: name,
                birthday: birthday,
                address: address,
                email: email,
                password: password,
                confirmPassword: confirmPassword
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#message-error").html(resposta);
                    $("#message-error").css("display", "block");
                    setTimeout(() => $("#message-error").css("display", "none"), 5000);
                } else {
                    $("#message-success").html("Signed up!");
                    $("#message-success").css("display", "block");
                    setTimeout(() => $("#message-success").css("display", "none"), 5000);
                }
            }

        });
        return false;
    });
</script>

</html>