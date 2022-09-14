<?php include("partials-front/menu.php"); ?>
<?php
//check wether the food id is set or no
if(isset($_GET['id']))
{
    //There's avalibale food id
    $food_id=$_GET['id']; 
}
else
{
    //Food id isn't set
    header('location:'.SITEURL);
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <?php
            //create query to get food information
            $sql="SELECT*FROM food WHERE id='$food_id'";
            //Excute the query
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if ($count==1)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                   //Get the information
                   $price=$row['price'];
                   $title=$row['title'];
                   $image_name=$row['image_name'];
                }
            }
            else
            {
               echo "<script>alert('Error')</script>";
            }
            
            ?>

            <form action="#" method ='POST' class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if($image_name=="")
                        {
                            echo "<div class='error'>There is not availibale image</div>";
                        }
                        else
                        {
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"class="img-responsive img-curve">
                            <?php
                        }
                        
                        ?>
                      
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food_title" value="<?php echo $title; ?>">
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact"  class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email"  class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Bulding,Street,City " class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php 
            if(isset($_POST['submit']))
            {
                //Get the information of the order
                $food=$_POST['food_title'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$qty*$price;
                $order_date=date("Y-m-d H:i:sa");
                $status="Ordered"; //Ordered On delivry Delivred cancelled 
                $consumer_name=$_POST['full-name'];
                $consumer_email=$_POST['email'];
                $consumer_contact=$_POST['contact'];
                $consumer_adress=$_POST['address'];
                //Create query to insert the info to database
                $sql2="INSERT INTO orders SET 
                food='$food',
                price=$price,
                qty=$qty,
                total=$total,
                orderdate='$order_date',
                status='$status',
                consumer_name='$consumer_name',
                consumer_contact='$consumer_contact',
                consumer_email='$consumer_email',
                consumer_adress='$consumer_adress'
                ";
                //Excute the query
                $res2=mysqli_query($conn, $sql2);
                //Check wether the query excuted succssfully
                if($res2==true)
                {
                    //Query excuted succssfully
                   $_SESSION['order']= "<div class='succssed'>Food ordered succssfully</div>";
                    header("location: ".SITEURL);
                }
                else
                {
                      //Query isn't excuted succssfully
                      echo "<script>alert('Faild To oreder the food')</script>";
                }

            }
            
            
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

   <?php include("partials-front/footer.php"); ?>