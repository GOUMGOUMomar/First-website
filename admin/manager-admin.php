<?php include("partials/menu.php"); ?>


       <!--Main content section starts-->
       <Div class='Main-content'>
          <div class="wrapper">
             
          <h1>Manage Admin</h1>



          <br/>
          <?php
             if(!isset($_SESSION['id-admin']))
             {
                $_SESSION['not-allowed']= "<script>alert('You Do not Have The Accss To This Part!');</script>";
                header("location: ".SITEURL.'admin/');
             }
             if(isset($_SESSION['add'])){
                echo $_SESSION['add']; //Display SESSION message
                unset ($_SESSION['add']); //Remove SESSION message 
             }
             if(isset($_SESSION['deleted'])){
                echo $_SESSION['deleted'];//Display SESSION message
                unset ($_SESSION['deleted']); //Display SESSION message
             }
             if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
             }
             if(isset($_SESSION['user_not_found'])){
                echo $_SESSION['user_not_found'];
                unset($_SESSION['user_not_found']);
             }
             if(isset($_SESSION['password_not_matched'])){
                echo $_SESSION['password_not_matched'];
                unset($_SESSION['password_not_matched']);
             }
             if(isset($_SESSION['password_passed'])){
                echo $_SESSION['password_passed'];
                unset($_SESSION['password_passed']);
             }
             ?>
             <br/><br/><br/>
          <!-- button to add admine-->
          <a href="add-admin.php" class="btn-primary">Add Admin</a>
          <br/> 
            
             <br/> 
             <div style="overflow-x: auto;" >
          <table class="tbl-full">
             <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Action</th>
             </tr>
             <?php
             //query to get all Admins
             $sql= "SELECT*FROM admin";
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
                     $full_name=$rows['full_name'];
                     $username=$rows['username'];
                     //Dispaly the values
                     ?>
                      <tr>
                           <td><?php echo $sn++; ?></td>
                           <td><?php echo $full_name; ?></td>
                           <td><?php echo $username; ?></td>
                           <td>
                   <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo$id;?>" class=btn-primary>Change Password</a>           
                   <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo$id;?>" class="btn-secondary">Update Admin</a>
                   <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-delete">Delete Admin</a>
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
          
          <div class="clear-fix"></div>
          </div>
       </Div>
       <!--Main contet section ends-->


      <?php include("partials/footer.php"); ?>