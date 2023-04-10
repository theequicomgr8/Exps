<?php  
include "config.php";
 
session_destroy();
unset($_SESSION["id"]);
unset($_SESSION["email"]); 
unset($_SESSION["role"]); 
//header("Location:https://exp.xapotechsystems.com/");
exit(header("Location: https://exp.xapotechsystems.com/admin/"));
//include 'header.php';




?> 