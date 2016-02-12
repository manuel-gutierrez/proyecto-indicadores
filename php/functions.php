<?php

function reportes_action(array $options = []) {
    require ('connDB.php');
    include ('session.php');
    $fecha_actual = date("Y-m-d H:i:s");
    $ip = getIP();
    $sql = "INSERT INTO reports (id_user, option_acces, action, date_action, description, ip_access)
		  VALUES ('$id_user', '$options[0]', '$options[1]', '$fecha_actual', '$options[2]', '$ip')";
    mysql_query($sql);
    mysql_close($link);
}

function getIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
}
    