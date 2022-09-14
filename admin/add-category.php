<?php include('partials/menu.php') ?>
<div class="main-content">
        <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php if(isset( $_SESSION['add'])){
            echo $_SESSION['add'];
            unset( $_SESSION['add']);
        }
        
        ?><br><br>


        <!-- Add category starts here-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class='tbl-30'>
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Category Title" class="case">
                </td>
            </tr>   
            <tr>
                <tr>
                    <td>Add Image </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No 
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Categorey" class="btn-secondary">
                </td>
            </tr>

            </table>

        </form>
        <!-- Add category ends here-->
        


    </div>
</div>
<?php include('partials/footer.php') ?>
<?php 
if(isset($_POST['submit'])){
    $title=$_POST['title'];
    if(isset($_POST['featured'])){
        $featured=$_POST['featured'];
    }
    else{
        $featured="No";
    }
    if(isset($_POST['active'])){
        $active=$_POST['active'];
    }
    else{
        $active="No";
    }
    if(isset($_FILES['image']['name'])){
        //upload the image
        $image_name=$_FILES['image']['name']; //e.g special.food.pnj
        //Auto rename image
        //Get the extension
        $ext= end(explode('.', $image_name)); //e.g pnj
        //Giv the image new name
        $image_name='Food category'.rand(0000,9999).'.'.$ext; //e.g Food category.1235

        $source_path=$_FILES['image']['tmp_name'];

        $destination_path="../images/category/".$image_name;
        //finally upload the image
        $upload=move_uploaded_file($source_path,$destination_path);
        //in case the image didn't uploaded the proccss will be stoped and redirct the page to add category
        if($upload==false){
            $_SESSION['faild to upload image']="<script>alert('Faild To Upload Image Please Try Again')</script>";
            header("location: ".SITEURL.'admin/add-category.php');
            //Stop the proccss
            die();
        }
    }
    else{
        //if the admin didn't upload the image it's name is gonna be blank
        $image_name="";
    }
    $sql="INSERT INTO category SET
          title='$title',
          image_name='$image_name',
          featured='$featured',
          active='$active'";
          $res=mysqli_query($conn,$sql);
          if($res==true){
              $_SESSION['add']="<div class='succss'>Category Added succssfully</div>";
              header("location: ".SITEURL.'admin/add-category.php');
          }
          else{
            $_SESSION['add']="<script>alert('Faild To Add Category Please try Again')</script>";
            header("location: ".SITEURL.'admin/add-category.php');
          }

}


?>