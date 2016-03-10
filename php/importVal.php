<?php

if( isset($_GET["id"])) {

	$query_id = $_GET["id"]; 
//	echo "$query_id";
}
else {
	echo "error en el get_id";
 // Redirecciona a  la pagina 404. 
}
$q = mysql_query("SELECT indicator_cod, indicator_name, indicator_description, equation_id, chart_type, indicator_goal, indicator_type FROM indicators WHERE indicator_id=$query_id",$link);
$valores = mysql_fetch_assoc($q);
$codigo = $valores['indicator_cod'];
$equation = $valores['equation_id'];
$nombre = $valores['indicator_name'];
$descrip = $valores['indicator_description'];
$grafico = $valores['chart_type'];
$meta = $valores['indicator_goal'];

$q = mysql_query("SELECT DATE(value_date) AS value_date, value_ind, value_id FROM indicatorvalues WHERE indicator_id=$query_id", $link);
$num=mysql_numrows($q);

?>