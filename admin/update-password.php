<?php include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>change Password</h1>
        <br><br>
        <?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tble-30">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password" class="case">
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password" class="case">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="case">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value=<?php echo $id; ?>>
                        <input type="submit" name="submit" value="Cahnge Password" class="btn-secondary" class="case">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php
   //check wether the submit button is clicked or not
   if(isset($_POST['submit'])){
       //the button is clicked
         $id=$_POST['id'];
         $current_password=md5($_POST['current_password']);
         $new_password=md5($_POST['new_password']);
         $confirm_password=md5($_POST['confirm_password']);
       //check wether the current user exists
       $sql="SELECT*FROM admin WHERE id=$id AND password='$current_password'";
       //Excute the qurey
       $res=mysqli_query($conn,$sql);
       if($res==true){
           //check wether data is availible or not
           $count=mysqli_num_rows($res);
           if($count==1){
               //user exists
               if($new_password==$confirm_password){
                   $sql2="UPDATE admin SET 
                   password='$new_password'
                   WHERE id=$id";
                   //Excute the qurey
                   $res2=mysqli_query($conn,$sql2);
                   //check wether the qurey is excuted
                   if($res2==true){
                       $_SESSION['password_passed']="<div class='succss'>Password Changed Succssfully.</div>";
                       header("location: ".SITEURL.'admin/manager-admin.php');
                   }
                   else{
                    $_SESSION['password_passed']="<div class='error'>Faild To Change Password,Please Try Again.</div>";
                    header("location: ".SITEURL.'admin/manager-admin.php');
                   }
               }
               else{
                $_SESSION['password_not_matched']="<div class='error'>Password Didn't Match,Please Try Again.</div>";
                header("location: ".SITEURL.'admin/manager-admin.php');
               }
           }
           else{
               //user doesn't exist
               $_SESSION['user_not_found']="<div class='error'>User Not Found.</div>";
               header("location: ".SITEURL.'admin/manager-admin.php');
           }
       }
   }
?>

<?php include("partials/footer.php"); ?>