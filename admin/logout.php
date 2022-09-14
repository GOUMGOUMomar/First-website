<?php 
include('../config/constante.php')
?>
<?php
session_destroy();
 header('location:'.SITEURL.'admin/login.php')
  ?>