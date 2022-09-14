<?php
include("../config/constante.php");
if (isset($_GET['id']) AND isset($_GET['image_name'])){
    //1.Get the Id
     $id=$_GET['id'];
     $image_name=$_GET['image_name'];
    
    if($image_name != ""){
        $path="../images/food/".$image_name;
        $remove= unlink($path);
    }
    if($remove==false){
        //Show the alert
        $_SESSION['remove image']="<script>alert('Faild To Remove Image')</script>";
        header("location: ".SITEURL.'admin/manager-food.php');
    }
    }
//2.create sql qurey to delet 
$sql="DELETE FROM food WHERE id=$id";
//Excute the qurey
$res=mysqli_query($conn,$sql);
//check wether the qurey is excuted successfully or not
if($res==true){
    //qurey is excuted succssfully
    $_SESSION['deleted food']="<div class='succss'>Food deleted succssfully.</div>";
    header('location: '.SITEURL.'admin/manager-food.php');
}
else{
    //qurey faild
    $_SESSION['deleted food']="<script>alert('Faild To Delete Category')</script>";
    header('location: '.SITEURL.'admin/manager-food.php');
}
//3.redirect to manage admin with displaying a message(The admin deleted or not)


?>