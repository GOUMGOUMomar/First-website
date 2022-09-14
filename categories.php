<?php include("partials-front/menu.php"); ?>
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
            //display all the categories
            //create the query
            $sql="SELECT*FROM category WHERE active='Yes'";
            //Excute the qurey
            $res=mysqli_query($conn,$sql);
            //count the rows
            $count=mysqli_num_rows($res);
            if($count>0){
                //We have data in database
                while($row=mysqli_fetch_assoc($res)){
                    //Get the value
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                          <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                if($image_name=="")
                                {
                                    echo "<div class='error'>There is not availibale image</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt=""class="img-responsive img-curve">
                                    <?php
                                }
                                
                                ?>
                               

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                         </a>
                    <?php
                }
            }
            else{
                //We don't have any data
                echo "<div class='error'>There is not availibale categories</div>";
            }
            
            
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


  <?php include("partials-front/footer.php"); ?>