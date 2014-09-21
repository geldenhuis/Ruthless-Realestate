<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Standard meta kludge -->
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="description" content="FIT2076 Assignment 2">
    <meta name="author" content="Luke Blues (25124463)">
    <meta name="keyword" content="">

    <title>Admin - Dashboard</title>

    <!-- CSS Styles -->
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/colors.css" rel="stylesheet">
    <link href="./assets/css/box.css" rel="stylesheet">
    <link href="./assets/css/sidebar.css" rel="stylesheet">
    <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        body {
            font-weight: 300;
            font-family: HelveticaNeue-Thin;
            background: #9b9b9b;
        }
        .form-signin {
            max-width: 280px;
            margin: 25% auto 10px;
        }
        .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            @include box-sizing(border-box);
        }
        input[type="text"] {
            margin-bottom: -1px;
            border-top: 1px solid transparent;
            border-right: 1px solid transparent;
            border-left: 1px solid transparent;
            box-shadow: none;
            border-radius: 3px 3px 0px 0px;
            &: focus {
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            }
        }
        input[type="password"] {
            z-index: 2;
            margin-bottom: 20px;
            border-top: none;
            border-bottom: 1px solid transparent;
            border-right: 1px solid transparent;
            border-left: 1px solid transparent;
            border-radius: 0px 0px 3px 3px;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            &: focus {
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0px 1px 0px 0px rgba(255, 255, 255, 0.5);
            }
        }
        .btn {
            border-radius: 3px;
            border: none;
        }

    </style>
</head>


<body>
    <!-- <div class="navbar nav-header" style="background:#fff;">
        <div class="header">
        </div>
    </div> -->
    <div class="container">
        <form class="form-signin">
            <h1 style="color: #fff">Welcome </h1>
            <h4 style="color: #fff">Please login to continue</h4>
            <input id="uname" type="text" class="form-control" name="uname" placeholder="Username" required autofocus="" />
            <input id="pword" type="password" class="form-control" name="pword" placeholder="Password" required />
            <div class="err-status" style="display:none; color: red;">Error</div>
            <input id="login-btn" class="btn btn-lg btn-primary btn-block" value="Login">
            <br>
            <div id="AddAlert" class="flash alert alert-danger" role="alert" style="display: none">
                <strong>Warning!</strong> Incorrect username or password please check your details and try again.
            </div>
        </form>
    </div>
</body>

<script>
    $("#login-btn").click(function () {
        //Hide the alert in-case it's visible.
        $("#AddAlert").hide();

        var $username = $("#uname").val();
        var $password = $("#pword").val();

        // Post the details to process-login.php
        $.post("process-login.php", {
            uname: $username,
            pword: $password
        }, function (data) {
            if (data == "Valid User") {
                window.location = ('./index.php');
            } else {
                $("#AddAlert").show();
                $('#uname').css('border-color', 'red');
                $('#pword').css('border-color', 'red');
                $("#uname").focus();
            }
        });
    });
</script>

</html>
