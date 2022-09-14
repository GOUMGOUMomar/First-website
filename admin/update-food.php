<?php include("partials/menu.php"); ?>
<?php
        //1.Get the Id of selected food
        $id=$_GET['id'];
        //2.Creat the qurey to get the details
        $sql="SELECT*FROM food WHERE id=$id";
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
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
                $description=$row['description'];
                $price=$row['price'];
                $current_category=$row['category_id'];
            }
            else{
                //Redirect to manage admin
                header("location: ".SITEURL."admin/manager-food.php");
            }
        }
        ?>
    <div class="main-content">
        <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
         <form action="" method="POST" enctype="multipart/form-data">
             <table class="tbl-30">
                 <tr>
                     <td>Title</td>
                     <td>
                         <input type="text" name="title"value="<?php echo $title; ?>" class="case">
                     </td>
                 </tr>
                 
                 <tr>
                     <td>Description</td>
                     <td>
                         <textarea name="description" cols="30" rows="5"class="bold"> <?php echo $description;?></textarea>
                     </td>
                 </tr>

                 <tr>
                     <td>Price</td>
                     <td>
                         <input type="number" name="price"value="<?php echo $price; ?>" class="case">
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
                                     $category_id=$row['id'];
                                     $category_title=$row['title'];
                                     ?>
                                     <option <?php if($current_category==$category_id){echo "Selected";} ?> value="<?php echo $category_id ?>"><?php echo $category_title; ?></option>
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
                         <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                         <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                     </td>
                 </tr>

                 <tr>
                     <td>Active</td>
                     <td>
                         <input <?php if($active=="Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes">Yes
                         <input <?php if($active=="No"){echo "Checked";} ?> type="radio" name="active" value="No">No
                     </td>
                 </tr>

                 <tr>
                     <td>
                         <input type="hidden" name="id" value="<?php echo $id; ?>">
                         <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                         <input type="submit" name="submit" value="Update Food" class="btn-secondary">
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
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $categpry=$_POST['category'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];
    

        if(isset($_FILES['image']['name'])){
            //upload the image
            $image_name=$_FILES['image']['name']; //e.g special.food.pnj
            if($image_name!=""){
            //Auto rename image
            //Get the extension
            $a=explode('.', $image_name);
            $ext= end($a); //e.g pnj 
            //Giv the image new name
                $image_name='Food'.rand(0000,9999).'.'.$ext; //e.g Food category.123
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/food/".$image_name;
                 //finally upload the image
                 $upload=move_uploaded_file($source_path,$destination_path);
                 if($upload==false){
                    $_SESSION['faild to upload image']="<script>alert('Faild To Upload Image Please Try Again')</script>";
                    header("location: ".SITEURL.'admin/manager-food.php');
                    //Stop the proccss
                    die();
                }
                //Delete the old image
                if($current_image!=""){
                    $remove_path="../images/food/".$current_image;
                    $remove= unlink($remove_path);
                }
            }
            else{
                $image_name=$current_image;
            }
           
            }
    
    else{
        $image_name=$current_image;
    }
   
    //create sql qurey to update 
    $sql1="UPDATE food set
    title='$title',
    description='$description',
    price=$price,
    category_id='$categpry',
    image_name='$image_name',
    featured='$featured',
    active='$active'
    WHERE id='$id'
    ";
    //Excute the qurey 
    $res1=mysqli_query($conn,$sql1);

    //Check wether the qurey is excuted succssfully or not
    if($res1==true){
        //qurey excuted succssfully
        $_SESSION['update-food']="<div class='succss'Food Updated Succssfully.</div>";
        //Redirect to manage admin
        header("location: ".SITEURL.'admin/manager-food.php');

    }
    else{
         //qurey faild to excute
         $_SESSION['update-food']="<script>alert('Faild To Update category')</script>";
         //Redirect to manage admin
        header("location: ".SITEURL.'admin/update-food.php');

    }
}

?>
