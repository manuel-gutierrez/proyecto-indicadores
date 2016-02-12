<?php
    $dbUsuario = "root";
    $dbClave = "";
    $dbServer = "localhost";
    $dbNombre = "grancolombiano_indicadores";
    
    $link = @mysql_connect($dbServer, $dbUsuario, $dbClave) or die ("Error en la conexi��n al servidor");
	mysql_set_charset('utf8');    
    @mysql_select_db($dbNombre, $link) or die ("Error en la conexi��n a la base de datos");
	
?>