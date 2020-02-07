<?php
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/loginAdministrator.css" />
    <meta name="theme-color" content="#262626" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>

<body>
    <div id="message-error" class="message-error">
    </div>
    <div class="container" id="container">
        <div class="login">
            <div class="title">
                <h2>Login</h2>
            </div>
            <form>
                <label><i class="fa fa-envelope" aria-hidden="true"></i> Email</label><br>
                <input type="text" name="email" id="email"><br>
                <label> <i class="fa fa-lock" aria-hidden="true"></i> Password</label><br>
                <input type="password" name="password" id="password"><br>
                <button type="submit" id="loginAdministrator">Enter</button>
            </form>
        </div>
    </div>
</body>

</html>

<script>
    $("#loginAdministrator").click(function() {
        var email = $("#email").val();
        var password = $("#password").val();
        $.ajax({
            url: '../ajax/loginAdministrator.php',
            dataType: 'text',
            data: {
                email: email,
                password: password
            },
            type: 'POST',
            success: function(resposta) {
                if (resposta) {
                    $("#message-error").html(resposta);
                    $("#message-error").css("display", "block");
                    setTimeout(() => $("#message-error").css("display", "none"), 5000);
                } else {
                    $(location).attr("href", "../admin/indexAdministrator.php");
                }
            }
        });
        return false;
    });
</script>