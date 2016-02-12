<?php
//
// SQL Query To Fetch Complete Indicators Info
$ses_sql=mysql_query("SELECT user_type FROM usuarios WHERE email='$user_check'", $link);
$row = mysql_fetch_assoc($ses_sql);
$userType = $row['user_type'];
if ($userType==0) {
	$q = mysql_query("SELECT * FROM usuarios", $link);
} else {
	echo "No tiene permiso para visualizar esta ventana";
}
$num=mysql_numrows($q);

/*if(!isset($login_session)){
mysql_close($link); // Closing Connection
//header('Location: index.php'); // Redirecting To Home Page 
} */
?>