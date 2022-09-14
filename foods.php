<?php include("partials-front/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php  
            //create query to get foods from database
            $sql="SELECT*FROM food WHERE active='Yes'";
            //Excute the query
            $res=mysqli_query($conn,$sql);
            //Count the rows
            $count=mysqli_num_rows($res);
            if($count>0)
            {
                //We have data
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the value
                    $id=$row['id'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                       <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            if($image_name=="")
                            {
                                 //We don't have image
                                 echo "<div class='error'>There is not availibale image</div>";
                            }
                            else
                            {
                                ?>
                                 <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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

                                <a href="<?php echo SITEURL ?>order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

               
               
                         
                <?php
               
            }
        }
            else
            {
                //We don't have database
                echo "<div class='error'>There is not availibale food</div>";
            }
            
            
            ?>

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include("partials-front/footer.php"); ?>