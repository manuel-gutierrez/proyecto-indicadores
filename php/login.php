<?php

include 'functions.php';
session_start();
// Starting Session
$error = '';
// Variable To Store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "No ha ingresado el usuario y/o la contraseña";
    } else {
        // Define $username and $password
        $username = $_POST['username'];
        $password = $_POST['password'];

        // To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
        // SQL query to fetch information of registerd users and finds user match.
        $query = mysql_query("SELECT * FROM usuarios WHERE contrasena=SHA1('$password') AND email='$username'", $link);
        $rows = mysql_num_rows($query);

        if ($rows == 1) {
            $registro = mysql_fetch_object($query);
            $GLOBALS ['usertype'] = $registro->user_type;

            $_SESSION['login_user'] = $username;
            $_SESSION["uid"] = "$%&yfddf0=893298I&?n]*d_i#c$#a)(d)!o%&r%&3e42s3d5a4srd5tc/][as{A}";
            // Initializing Session
            if ($GLOBALS ['usertype'] == 0) {
                header("location: ../granC/inicio.php");
                reportes_action([0 => 'login', 1 => 'acceso', 2 => 'El usuario accedio correctamente al sistema.']);
            } else {
                header("location: ../granC/inicio1.php");
                reportes_action([0 => 'login', 1 => 'acceso', 2 => 'El usuario accedio correctamente al sistema.']);
            }
            // Redirecting To Other Page
        } else {
            $error = "El usuario y/o la contraseña son inválidos";
        }
        mysql_close($link);
        // Closing Connection*/
    }
}