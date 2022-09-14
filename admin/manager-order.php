<?php include("partials/menu.php"); ?>
    <div class="main-content">
        <div class="wrapper">
        <h1>Manage Orders</h1>
         
          <br/> <br/> <br/>
          <div style="overflow-x: auto;" >
          <table class="tbl-full">
             <tr>
                <th>S.N</th>
                <th>Consumer Name</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Adress</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Action</th>
             </tr>
             <?php
             //Get the information from DB
             $sql="SELECT*FROM orders ORDER BY id DESC";
             $res=mysqli_query($conn,$sql);
             $count=mysqli_num_rows($res);
             if($count>0)
             {
                $sn=1;
                while($row=mysqli_fetch_assoc($res))
                {
                   $id=$row['id'];
                   $consumer_name=$row['consumer_name'];
                   $food_title=$row['food'];
                   $price=$row['price'];
                   $qty=$row['qty'];
                   $totale=$row['total'];
                   $date=$row['orderdate'];
                   $status=$row['status'];
                   $adress=$row['consumer_adress'];
                   $contact=$row['consumer_contact'];
                   $email=$row['consumer_email'];
                   ?>
               <tr>
                   <td><?php echo $sn++ ?></td>
                  <td><?php echo $consumer_name; ?></td>
                  <td><?php echo $food_title; ?></td>
                  <td>$<?php echo $price; ?></td>
                  <td><?php echo $qty; ?></td>
                  <td>$<?php echo $totale; ?></td>
                  <td><?php echo $date; ?></td>
                           <td><?php if($status=="Ordered")
                           {
                              echo "<label>$status</label>";
                           } 
                           elseif($status=="On Delivry")
                           {
                              echo "<label style='color:orange;'>$status</label>";
                           }
                           elseif($status=="Delivred")
                           {
                              echo "<label style='color:green;'>$status</label>";
                           }
                           elseif($status=="Cancelled")
                           {
                              echo "<label style='color:red;'>$status</label>";
                           }
                           ?></td>
                  <td><?php echo $adress; ?></td>
                  <td><?php echo $contact; ?></td>
                  <td><?php echo $email; ?></td>
                  <td>
                  <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo$id;?>" class="btn-secondary">Update</a>
                  <a href="<?php echo SITEURL;?>admin/delete-order.php?id=<?php echo $id;?>" class="btn-delete">Delete</a>
                  </td>
               </tr>
                   <?php
                }
             }
             else
             {
                echo "<div>There is not any avalibale order</div>";
             }
             
             ?>
                
          </table>
          </div>
        </div>
    </div>
<?php include("partials/footer.php"); ?>