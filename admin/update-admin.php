<?php include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
        //1.Get the Id of selected admin
        $id=$_GET['id'];
        //2.Creat the qurey to get the details
        $sql="SELECT*FROM admin WHERE id=$id";
        //3.Excute the qurey
        $res=mysqli_query($conn,$sql);
        //4.Check wether the qurey is escuted or not
        if($res==true){
            //check wether the data is availibale
            $count=mysqli_num_rows($res);
            //check wether we have admin data
            if($count==1){
                //we have admin data
                //Get admin's detail
                $row=mysqli_fetch_assoc($res);
                $full_name=$row['full_name'];
                $usernam=$row['username'];
            }
            else{
                //Redirect to manage admin
                header("location: ".SITEURL."admin/manager-admin.php");
            }
        }
        ?>
        <form action="" method="POST">
            <table class="tble-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>" class="case">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $usernam; ?>"class="case">
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                       <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    //create sql qurey to update 
    $sql="UPDATE admin set
    full_name='$full_name',
    username='$username'
    WHERE id='$id'
    ";
    //Excute the qurey 
    $res=mysqli_query($conn,$sql);

    //Check wether the qurey is excuted succssfully or not
    if($res==true){
        //qurey excuted succssfully
        $_SESSION['update']="<div class='succss'>Admin Updated Succssfully.</div>";
        //Redirect to manage admin
        header("location: ".SITEURL.'admin/manager-admin.php');

    }
    else{
         //qurey faild to excute
         $_SESSION['update']="<div class='error'>Faild To Update Admin Please Try Again.</div>";
         //Redirect to manage admin
         header("location: ".SITEURL.'admin/manager-admin.php');

    }
}

?>
<?php include("partials/footer.php"); ?>