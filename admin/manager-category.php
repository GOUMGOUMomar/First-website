<?php include("partials/menu.php");?>
    <div class="main-content">
        <div class="wrapper">
        <h1>Manage Categories</h1><br><br>
        
        <?php if(isset( $_SESSION['add'])){
            echo $_SESSION['add'];
            unset( $_SESSION['add']);
        }
        if(isset( $_SESSION['update-category'])){
          echo  $_SESSION['update-category'];
          unset ( $_SESSION['update-category']);
        } 
        if(isset( $_SESSION['deleted category'])){
          echo $_SESSION['deleted category'];
          unset( $_SESSION['deleted category']);
        }
        if(isset($_SESSION['remove image'])){
          echo $_SESSION['remove image'];
          unset($_SESSION['remove image']);
        }
        
        
        ?><br><br><br><br>
          <!-- button to add category-->
          <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
          <br/> <br/> <br/>
          <div style="overflow-x: auto;" >
        <table class="tbl-full">
             <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
             </tr>
             <?php
             
              //query to get all Categories
              $sql= "SELECT*FROM category";
              //Excute the qurey
              $res=mysqli_query($conn,$sql);
              //Check wether the qurey is excuted or not
              if($res==True){
                 //count rows to check wether we have data in our database or not
                 $count=mysqli_num_rows($res);//Function to get all the rows in data
                 //check the num of rows
                 if($count>0){
                    $sn=1;
                    //We have data in database
                   while($rows=mysqli_fetch_assoc($res)){
                      //Using while loop to get all the data from database
                      //While loop will run as long as we have data in database
                      //Get the data
                      $id=$rows['id'];
                      $title=$rows['title'];
                      $image_name=$rows['image_name'];
                      $featured=$rows['featured'];
                      $active=$rows['active'];

                      //Dispaly the values
                      ?>
                       <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php 
                               //check wether the image is availibale or not
                               if($image_name!=""){
                                 //Image is availibale
                                 //Display Image
                                 ?>
                                 <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" width="100px">
                                 <?php
                               }
                               else{
                                 //Image isn't added
                                 echo "<div class='error'>Image isn't Added.</div>";
                               }
                            ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                              
                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo$id;?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Category</a>
                    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>&category<?php echo $id; ?>" class="btn-delete">Delete Category</a>
                 </td>
                 </tr>
                 <?php
                  }
                }
                else{
                   //We don't have data in database
                }

             }
             ?>
          </table>
          </div>
        </div>
    </div>
<?php include("partials/footer.php"); ?>