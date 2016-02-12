<?php
include 'functions.php';
session_start();
reportes_action([0 => 'logout', 1 => 'cierre', 2 => 'El usuario salio correctamente del sistema.']); 
if(session_destroy()) // Destroying All Sessions
{   
header("Location: ../index.php"); // Redirecting To Home Page
}
?>