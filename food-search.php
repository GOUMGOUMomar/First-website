<?php include("partials-front/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
             //Get the search keyword
             $search=$_POST['search'];
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            //Creat QUERY to get the food from database
            $sql="SELECT*FROM food WHERE title LIKE'%$search%'OR description LIKE'%$search%'";
            //Excute the query
            $res=mysqli_query($conn,$sql);
            //Count the number of rows
            $count=mysqli_num_rows($res);
            if($count>0)
            {
                //Data is availibale
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the value
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>
                     <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //check wether the image is availibale
                            if($image_name=="")
                            {
                                echo "<div>There is not availibale Image</div>";
                            }
                            else
                            {
                                //Image is availibale
                                ?>
                                 <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"class="img-responsive img-curve">
                                <?php
                            }
                            
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                //Data isn't availibale
                echo "<div class='error'>There is not availibale food</div>";
            }
            
            
            ?>

           

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include("partials-front/footer.php"); ?>