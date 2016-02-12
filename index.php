<?php
require 'php/connDB.php';
include ('php/login.php');
// Includes Login Script
/* 		if(isset($_SESSION['login_user'])){
  header("location: profile.php");
  } */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Indicadores - CGC | Ingreso</title>
        <link rel="shortcut icon" href="pics/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="pics/apple-touch-icon.png" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            function nobackbutton() {
                history.go(1);               
                window.location.hash = "no-back-button";
                window.location.hash = "Again-No-back-button" //chrome
                window.onhashchange = function () {
                window.location.hash = "no-back-button";
                }

            }
        </script>
    </head>
    <body class="login-page" onload="nobackbutton();">
        <div class="login-box">
            <div class="login-logo">
                <img src="pics/logo1.png" height="150px" alt="Grancolombiano"/>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Inicie sesión</p>
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <input id="usuario" name="username" type="email" class="form-control" placeholder="Email" />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña" />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <span><?php echo $error; ?></span>
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button name="submit" type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                        </div><!-- /.col -->
                    </div>
                </form>
                <a href="#">Olvidé mi contraseña</a><br>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>