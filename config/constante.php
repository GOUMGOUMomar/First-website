<?php
//SESSION start
session_start();
//create constatnte to store non reapeting values
define('SITEURL','http://localhost/First-website/');
define('LOCALHOST','localhost');
define('DB_NAME','first-website');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die (mysqli_error());
$db_select=mysqli_select_db($conn,DB_NAME) or die (mysqli_error());

?>