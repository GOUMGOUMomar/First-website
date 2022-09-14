<?php include("partials-front/menu.php"); ?>
<?php
//check wether the id is passed
if(isset($_GET['category_id']))
{
    //Id passed Let's get it
    $category_id=$_GET['category_id'];
     //Create the query to get category title
     $sql="SELECT title FROM category WHERE id='$category_id'";
     //Excute the query
     $res=mysqli_query($conn,$sql);
     //Get the value
     $row=mysqli_num_rows($res);
     $row=mysqli_fetch_assoc($res);
     $category_title=$row['title'];
}
else
{
    //Id isn't passed
    header('location:'.SITEURL);
}


?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
             //Create the query to get food based on category
             $sql2="SELECT*FROM food WHERE category_id='$category_id'";
             //Excute the qurey
             $res2=mysqli_query($conn,$sql2);
             $count2=mysqli_num_rows($res2);
             if($count2>0)
             {
                //We hava a data
                //Get the value
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id=$row2['id'];
                  $title=$row2['title'];
                  $price=$row2['price'];
                  $description=$row2['description'];
                  $image_name=$row2['image_name'];
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
                 //We don't have any food
                 echo "<div class='error'>There is not availibale food</div>";
             }
            ?>

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials-front/footer.php"); ?>