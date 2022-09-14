<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
                    <?php
                    if(isset($_GET['id']))
                    {
                    //Get the id  of food
                    $id=$_GET['id'];
                     //Create query to get information from DB
                     $sql="SELECT*FROM orders WHERE id=$id";
                     $res=mysqli_query($conn,$sql);
                     $count=mysqli_num_rows($res);
                     if($count==1)
                     {
                         $row=mysqli_fetch_assoc($res);
                       //Get the information from DB
                       $consumer_name=$row['consumer_name'];
                       $qty=$row['qty'];
                       $price=$row['price'];
                       $total=$row['total'];
                       $consumer_contact=$row['consumer_contact'];
                       $consumer_email=$row['consumer_email'];
                       $consumer_adress=$row['consumer_adress'];
                       $food_name=$row['food'];
                       $status=$row['status'];
                     }
                     else
                     {
                       //header("location: ".SITEURL.'admin/manager-order.php');
                     }
                    }
                    else
                    {
                       // header("location: ".SITEURL.'admin/manager-order.php');
                    }
                     ?>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Consumer Name</td>
                    <td><?php echo $consumer_name; ?></td>
                </tr>
                
                <tr>
                    <td>Consumer Email</td>
                    <td>
                        <input type="text" name="email" value="<?php echo $consumer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Consumer Contact</td>
                    <td>
                        <input type="text" name="contact" value="<?php echo $consumer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Consumer Adress</td>
                    <td>
                        <textarea name="adress"  cols="30" rows="5"><?php echo $consumer_adress; ?></textarea>
                    </td>
                    <tr>
                        
                    </tr>
                </tr>

                <tr>
                    <td>Food Name</td>
                    <td><?php echo $food_name; ?></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>$<?php echo $price; ?></td>
                </tr>
                

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "Selected";} ?>value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivry"){echo "Selected";} ?>value="On Delivry">On Delivry</option>
                            <option <?php if($status=="Delivred"){echo "Selected";} ?>value="Delivred">Delivred</option>
                            <option <?php if($status=="Cancelled"){echo "Selected";} ?>value="Cancelled">Cancelled</option>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="hidden" name="total" value="<?php echo $total; ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include("partials/footer.php"); ?>
<?php
//refrech DB value after editing
if(isset($_POST['submit']))
{
//Get the new information
$consumer_adress=$_POST['adress'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$status=$_POST['status'];
$consumer_email=$_POST['email'];
$consumer_contact=$_POST['contact'];
$total=$qty*$price;


$sql1="UPDATE orders SET
consumer_adress='$consumer_adress',
qty='$qty',
status='$status',
consumer_email='$consumer_email',
consumer_contact='$consumer_contact',
total='$total'
WHERE id='$id'
";
$res1=mysqli_query($conn,$sql1);

if($res1==true)
{
   header("location: ".SITEURL.'admin/manager-order.php');
}
else
{
    echo "<script>alert('Faild To Update Order ')</script>";
}
}
?>