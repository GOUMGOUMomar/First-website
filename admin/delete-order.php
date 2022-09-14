<?php include ("../config/constante.php"); 

$id=$_GET['id'];

$sql="DELETE FROM orders WHERE id=$id";

$res=mysqli_query($conn,$sql);

header('location: '.SITEURL.'admin/manager-order.php');


?>