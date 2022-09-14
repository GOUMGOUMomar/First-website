<?php
include("../config/constante.php");
//1.Get the Id
$id=$_GET['id'];
//2.create sql qurey to delet 
$sql="DELETE FROM admin WHERE id=$id";
//Excute the qurey
$res=mysqli_query($conn,$sql);
//check wether the qurey is excuted successfully or not
if($res==true){
    //qurey is excuted succssfully
    $_SESSION['deleted']="<div class='succss'>Admin deleted succssfully.</div>";
    header('location: '.SITEURL.'admin/manager-admin.php');
}
else{
    //qurey faild
    $_SESSION['deleted']="<div class='error'>Faild To Delete The Admin.</div>";
    header('location: '.SITEURL.'admin/manager-admin.php');
}
//3.redirect to manage admin with displaying a message(The admin deleted or not)




?>