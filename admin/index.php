<?php include("partials/menu.php");?>
       <!--Main content section starts-->
       <Div class='Main-content'>
          <div class="wrapper">
          <h1>Dashborad</h1>
          <br><br>
          <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset ($_SESSION['login']);
            }
            
            ?><br><br>
          <div class ="col-4 text-center">
             <?php
             $sql="SELECT*FROM category";
             $res=mysqli_query($conn,$sql);
             $count=mysqli_num_rows($res);
             
             ?>
             <h1><?php echo $count; ?></h1>
             <br />
             Categoris
          </div> 
          <div class ="col-4 text-center">
          <?php
             $sql2="SELECT*FROM food";
             $res2=mysqli_query($conn,$sql2);
             $count2=mysqli_num_rows($res2);
             
             ?>
             <h1><?php echo $count2; ?></h1>
             <br />
            Foods
          </div> 
          <div class ="col-4 text-center">
          <?php
             $sql3="SELECT*FROM orders";
             $res3=mysqli_query($conn,$sql3);
             $count3=mysqli_num_rows($res3);
             
             ?>
             <h1><?php echo $count3; ?></h1>
             <br />
            Totale Orders
          </div> 
          <div class ="col-4 text-center">
             <?php
             $sql4="SELECT SUM(total) AS Total FROM orders WHERE status='Delivred'";
             $res4=mysqli_query($conn,$sql4);
             $row4=mysqli_fetch_assoc($res4);

             $totale_revenue=$row4['Total'];
             
             ?>
             <h1>$<?php 
             if($totale_revenue==0){echo "0";}
             else {echo  $totale_revenue;} ?></h1>
             <br />
             Revenue Generated
          </div> 
          <div class="clear-fix"></div>
          </div>
       </Div>
       <!--Main contet section ends-->


     <?php include("partials/footer.php"); ?>