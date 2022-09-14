<?php include("partials/menu.php"); ?>
    <div class="main-content">
        <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
        //1.Get the Id of selected admin
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        //2.Creat the qurey to get the details
        $sql="SELECT*FROM category WHERE id=$id";
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
                $title=$row['title'];
                $featured=$row['featured'];
                $active=$row['active'];
            }
            else{
                //Redirect to manage admin
                header("location: ".SITEURL."admin/manager-admin.php");
            }
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tble-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" class="case">
                    </td>
                </tr>
                <tr>
                <td>Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                </tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                </td>
            </tr>
                <tr>
                    <td colspan="5">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                       <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include("partials/footer.php"); ?>
<?php

//check wether the submit button is clicked or not
if(isset($_POST['submit'])){
    //the button is clicked
    $title=$_POST['title'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];

    if(isset($_FILES['image']['name'])){
        //upload the image
        $new_name=$_FILES['image']['name']; //e.g special.food.pnj
        if($new_name!=""){
                //Auto rename image
                //Get the extension
                $ext= end(explode('.', $new_name)); //e.g pnj
                //Giv the image new name
            $new_name='Food'.rand(0000,9999).'.'.$ext; //e.g Food category.123
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$new_name;
             //finally upload the image
             $upload=move_uploaded_file($source_path,$destination_path);
             if($upload==false){
                $_SESSION['faild to upload image']="<script>alert('Faild To Upload Image Please Try Again')</script>";
                header("location: ".SITEURL.'admin/manager-category.php');
                //Stop the proccss
                die();
            }
            if($current_image!=""){
                $remove_path="../images/food/".$current_image;
                $remove= unlink($remove_path);
            }
        }
        else{
            $new_name=$image_name;
        }
        }
        else{
            $new_name=$image_name;
        }
    //create sql qurey to update 
    $sql1="UPDATE category set
    title='$title',
    image_name='$new_name',
    featured='$featured',
    active='$active'
    WHERE id='$id'
    ";
    //Excute the qurey 
    $res=mysqli_query($conn,$sql1);

    //Check wether the qurey is excuted succssfully or not
    if($res==true){
        //qurey excuted succssfully
        $_SESSION['update-category']="<div class='succss'Category Updated Succssfully.</div>";
        //Redirect to manage admin
        header("location: ".SITEURL.'admin/manager-category.php');

    }
    else{
         //qurey faild to excute
         $_SESSION['update-category']="<script>alert('Faild To Update category')</script>";
         //Redirect to manage admin
         header("location: ".SITEURL.'admin/manager-category.php');

    }
}

?>
