<?php include('../config/constante.php');
      include('login-check.php')
?>
<?php
if(isset($_SESSION['id-admin']))
{
   ?>
   <html>
   <head>
      <title>Food order website-Home page</title>
      <link rel="stylesheet" href="../css/admin.css">
      <link rel="stylesheet" href="../bootstrap/bootsrap/bootstrap.min.css">
   </head>
   
   <body>
       <!--Menu section starts-->
       <Div class='Menu text-center'>
          <div class="wrapper">
            <ul>
               <li><a href="index.php">Home</a></li>
               <li><a href="manager-admin.php">Admin</a></li>
               <li><a href="manager-category.php">Category</a></li>
               <li><a href="manager-food.php">Food</a></li>
               <li><a href="manager-order.php">Orders</a></li>
               <li class="logout"><a href="logout.php">Logout</a></li>
            </ul>
          </div>
       </Div>
       <!--Menu section ends--><?php
}
else
{
   ?>
   <html>
   <head>
      <title>Food order website-Home page</title>
      <link rel="stylesheet" href="../css/admin.css">
   </head>

   <body>
       <!--Menu section starts-->
       <Div class='Menu text-center'>
          <div class="wrapper">
            <ul>
               <li><a href="index.php">Home</a></li>
               <li><a href="manager-category.php">Category</a></li>
               <li><a href="manager-food.php">Food</a></li>
               <li><a href="manager-order.php">Orders</a></li>
               <li class="logout"><a href="logout.php">Logout</a></li>
            </ul>
          </div>
       </Div>
       <!--Menu section ends--><?php
}

?>
