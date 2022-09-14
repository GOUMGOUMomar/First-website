<?php
include("../config/constante.php");
if (isset($_GET['id']) AND isset($_GET['image_name'])){
//1.Get the Id
 $id=$_GET['id'];
 $image_name=$_GET['image_name'];

if($image_name != ""){
    $path="../images/category/".$image_name;
    $remove= unlink($path);
}
if($remove==false){
    //Show the alert
    $_SESSION['remove image']="<script>alert('Faild To Remove Image')</script>";
    header("location: ".SITEURL.'admin/manager-category.php');
}
}
//2.create sql qurey to delet 
//First we delete foods that matched with category
$sql2="DELETE FROM food WHERE category_id=$id";
$res2=mysqli_query($conn,$sql2);

$sql="DELETE FROM category WHERE id=$id";
//Excute the qurey
$res=mysqli_query($conn,$sql);
//check wether the qurey is excuted successfully or not
if($res==true){
    //qurey is excuted succssfully
    
    $_SESSION['deleted category']="<div class='succss'>Category deleted succssfully.</div>";
    header('location: '.SITEURL.'admin/manager-category.php');
}
else{
    //qurey faild
    $_SESSION['deleted category']="<script>alert('Faild To Delete Category')</script>";
    header('location: '.SITEURL.'admin/manager-category.php');
}
//3.redirect to manage admin with displaying a message(The admin deleted or not)


?>