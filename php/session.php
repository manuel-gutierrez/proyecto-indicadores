<?php

@session_start();
// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql = mysql_query("SELECT * FROM usuarios WHERE email='$user_check'", $link);
$row = mysql_fetch_assoc($ses_sql);
$id_user = $row['id_usuario'];
$login_mail = $row['email'];
$login_fn = $row['first_name'];
$login_ln = $row['last_name'];
$login_usertype = $row['user_type'];
$login_occupation = $row['occupation'];
$login_pic = $row['pic'];
//if(!isset($login_session)){
//mysql_close($link); // Closing Connection
//header('Location: index.php'); // Redirecting To Home Page
//}
///////////TIMEOUT/////////////////7

$time = $_SERVER['REQUEST_TIME'];
$_SESSION['LAST_ACTIVITY'];
/**
 * el tiempo se especifica en segundos.
 */
$timeout_duration = 900;

if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    unset($time, $_SESSION['LAST_ACTIVITY'], $timeout_duration);
    header('Location: php/msgTimeOut.php');
}

$_SESSION['LAST_ACTIVITY'] = $time;
