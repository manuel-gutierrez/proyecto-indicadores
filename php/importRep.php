<?php
//
// SQL Query To Fetch Complete Indicators Info
$q=mysql_query("SELECT * FROM reports", $link);
$row = mysql_fetch_assoc($ses_sql);
$num=mysql_numrows($q);

/*if(!isset($login_session)){
mysql_close($link); // Closing Connection
//header('Location: index.php'); // Redirecting To Home Page 
} */
?>