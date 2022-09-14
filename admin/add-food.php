<?php include("partials/menu.php"); ?>
<div class="main-content">
     <div class="wrapper">
         <h1>Add Food</h1>
         <br><br>
         <?php
         if(isset( $_SESSION['faild to upload image'])){
             echo  $_SESSION['faild to upload image'];
             unset( $_SESSION['faild to upload image']);
         }
         if(isset( $_SESSION['add'])){
             echo  $_SESSION['add'];
             unset( $_SESSION['add']);
         }
         ?>
         <form action="" method="POST" enctype="multipart/form-data">
             <table class="tbl-30">
                 <tr>
                     <td>Title</td>
                     <td>
                         <input type="text" name="title" placeholder="Title of food" class="case">
                     </td>
                 </tr>
                 
                 <tr>
                     <td>Description</td>
                     <td>
                         <textarea name="description" id="" cols="30" rows="5" placeholder="Food Description" class="bold"></textarea>
                     </td>
                 </tr>

                 <tr>
                     <td>Price</td>
                     <td>
                         <input type="number" name="price" class="case">
                     </td>
                 </tr>

                 <tr>
                     <td>Image</td>
                     <td>
                         <input type="file" name="image">
                     </td>
                 </tr>

                 <tr>
                     <td>Category</td>
                     <td>
                         <select name="category" >
                             <?php
                             //Get categories from database
                             //Create The qurey
                             $sql="SELECT*FROM category WHERE active='Yes'";
                             //Excute the qurey
                             $res=mysqli_query($conn,$sql);
                             //count the rows
                             $count=mysqli_num_rows($res);
                             //If count is greater then zero then we have availiale categories
                             if($count>0){
                                 while($row=mysqli_fetch_assoc($res)){
                                     //get the details of category
                                     $id=$row['id'];
                                     $title=$row['title'];
                                     ?>
                                     <option value="<?php echo $id ?>"><?php echo $title; ?></option>
                                     <?php
                                 }
                             }
                             else{
                                 //We don't have avilibale categoris
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                             }
                             ?>
                         </select>
                     </td>
                 </tr>

                 <tr>
                     <td>Featured</td>
                     <td>
                         <input type="radio" name="featured" value="Yes">Yes
                         <input type="radio" name="featured" value="No">No
                     </td>
                 </tr>

                 <tr>
                     <td>Active</td>
                     <td>
                         <input type="radio" name="active" value="Yes">Yes
                         <input type="radio" name="active" value="No">No
                     </td>
                 </tr>

                 <tr>
                     <td colspan="2">
                         <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                     </td>
                 </tr>
             </table>
         </form>
     </div>
</div>

<?php include("partials/footer.php"); ?>
<?php 
//check wether the button is clicked
if(isset($_POST['submit'])){
    //button is clicked
    //upload data to database
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $categpry=$_POST['category'];
    //check wether featured is clicked or not
    if(isset($_POST['featured'])){
        //clicked
        $featured=$_POST['featured'];
    }
    else{
        $featured="No";//Settin Default Value
    }
    //check wether active is clicked or not
    if(isset($_POST['active'])){
        $active=$_POST['active'];
    }
    else{
        $active="No";//Settin Default Value
    }
    //upload The Image if it's selected
    if(isset($_FILES['image']['name'])){
        //image uploaded
        $image_name=$_FILES['image']['name'];
        //auto rename the image
        //get the extension
        $ext= end(explode('.', $image_name)); //e.g pnj
        //give the image new name
        $image_name='Food '.rand(0000,9999).'.'.$ext; //e.g Food category.1235
        $source_path=$_FILES['image']['tmp_name'];
        $destination_path="../images/food/".$image_name;
        //upload to database
        $upload=move_uploaded_file($source_path,$destination_path);
        //in case the image didn't uploaded the proccss will stop with alert message
        if($upload==false){
            //image didn't uploaded
            $_SESSION['faild to upload image']="<script>alert('Faild To Upload Image Please Try Again')</script>";
            header("location: ".SITEURL.'admin/add-food.php');
            //Stop the proccss
            die();
        }
    }
    else{
        //if the admin didn't upload any image
        $image_name="";
    }
    $sql="INSERT INTO food SET 
    title='$title',
    description='$description',
    price=$price,
    category_id='$categpry',
    image_name='$image_name',
    featured='$featured',
    active='$active'
    ";
    $res=mysqli_query($conn,$sql);
    if($res==true){
        $_SESSION['add']="<div class='succss'>Food Added succssfully</div>";
        header("location: ".SITEURL.'admin/add-food.php');
    }
    else{
      $_SESSION['add']="<script>alert('Faild To Add Food Please try Again')</script>";
      header("location: ".SITEURL.'admin/add-food.php');
    }
}

?>