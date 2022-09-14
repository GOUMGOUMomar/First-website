<?php include("partials/menu.php"); ?>
    <div class="main-content">
        <div class="wrapper">
        <h1>Manage Food</h1>
        <br  /> <br>
        <?php 
        if(isset($_SESSION['deleted food'])){
           echo $_SESSION['deleted food'];
           unset($_SESSION['deleted food']);
        }
      
        ?><br><br>
          <!-- button to add admine-->
          <a href="add-food.php" class="btn-primary">Add Food</a>
          <br/> <br/> <br/>
          <div style="overflow-x: auto;" >
          <table class="tbl-full">
             <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
             </tr>
             <?php
               
               //query to get all Categories
               $sql= "SELECT*FROM food";
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
                       $price=$rows['price'];
                       $description=$rows['description'];
                       ?>
                       
               <tr>
               <td><?php echo $sn++; ?></td>
                <td><?php echo $title; ?></td>
                <td>$<?php echo $price; ?></td>
                <td><?php 
                //check wether the image is availibale or not
                if($image_name!=""){
                  //Image is availibale
                  //Display Image
                  ?>
                  <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" width="100px">
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
                  <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Food</a>
                   <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-delete">Delete Food</a>
                </td>
                               
               </tr>
               
               <?php
               }
            }
            else{
                echo "<tr><td colspan='7' class='erro'>Food is not Added Yet</td></tr>";
            }
         }
               
               ?>  
         
    
          </table>
          </div>
        </div>
    </div>
<?php include("partials/footer.php"); ?>