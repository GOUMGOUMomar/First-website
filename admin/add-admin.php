<?php if(isset($_SESSION['id']))
{
   include("partials/menu.php");
}
else
{
   include("partials/menu2.php");
} ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
            
            
            ?>
        <form action="" method="POST">
        <table class="tble-30">
            <tr>
                <td>Full Name</td>
                <td><input type="text" name="full_name" placeholder="Please Enter Your Name"class="case"></td>
            </tr>
            <tr>
                <td>User Name</td>
                <td><input type="text" name="username" placeholder="Please Enter Your User Name"class="case"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" placeholder="Please Enter Your Password"class="case"></td>
            </tr>
            <tr>
                <td colspan=2>
                   <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        
        </form>
        
    </div>
</div>

<?php include("partials/footer.php"); ?>

<?php
//process the value and save it un database
//check wether the subbmit button is clicked or not
if(isset ($_POST['submit'])){
    //button clickes
    //1.Get the data from form
     $full_name=$_POST["full_name"];
     $username=$_POST["username"];
     $password=MD5($_POST["password"]);//password encrypted by MD5
     //2.Sql query to save the data in database
    $sql= "INSERT INTO admin set
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
    //3.Ecxecuting query and saving data in database
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
    //check whether the data is inserted and display the appropriate message
    if($res==true){
        //Data inserted
        //Display that the admin is inserted
        $_SESSION['add']="<div class='succss'>Admin Aded Successfully.</div>";
        //Redirect page to manage Admin
        header("location: ".SITEURL.'admin/manager-admin.php');
    }
    else{
         //Data inserted
        //Display that the admin isn't inserted
        $_SESSION['add']="<div class='error'>Faild To Delete Admin.</div>";
        //Redirect page to manage Admin
        header("location: ".SITEURL.'admin/manager-admin.php');
    }
}
?>