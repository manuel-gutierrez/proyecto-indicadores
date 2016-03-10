<?php


// SQL Query To Fetch Complete Indicators Info
$ses_sql=mysql_query("SELECT user_type, area_id FROM usuarios WHERE email='$user_check'", $link);
$row = mysql_fetch_assoc($ses_sql);
$userType = $row['user_type'];
$userArea = $row['area_id'];
if ($userType==0) {
    $q = mysql_query("SELECT indicator_id, indicator_cod, area_id, objective_id, indicator_name, equation_id, indicator_goal, indicator_type, chart_type \n"
        . "FROM (SELECT id_ao, objective_id, area_id FROM areas_objectives) AS id_ao\n"
        . "INNER JOIN indicators\n"
        . "USING (id_ao)", $link);
} else {

    $q = mysql_query("SELECT indicator_id, indicator_cod, equation_id, area_id, objective_id, indicator_name, indicator_goal , indicator_type, chart_type \n"
        . "FROM (SELECT id_ao, objective_id, area_id FROM areas_objectives WHERE area_id=$userArea) AS id_ao\n"
        . "INNER JOIN indicators\n"
        . "USING (id_ao)", $link);
}
$num=mysql_numrows($q);
?>