
<?php include('partials-front/menu.php'); ?>

<?php 
    //Check whether food is is set or not
    if(isset($_GET['food_id']))
    {
        //Get the food id and details of the selected food
        $food_id = $_GET['food_id'];

        //Get the details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //Execute the query
        $res = mysqli_query($conn, $sql);
        //Count the rows
        $count = mysqli_num_rows($res);
        //Check whether the data is available or not
        if($count==1)
        {
            //We have data
            //Get the data from database
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $description = $row['description'];
            $image_name = $row['image_name'];
        }
        else
        {
            //Food not available
            //Redirect to home page
            header('location:'.SITEURL);
        }
    }
    else
    {
        //Redirect to home page
        header('location:'.SITEURL);
    }
?>

<section class="food-menu">
        <div class="container">
            
            <h2 class="text-center">Fill out to add the item(s) to your cart</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-order-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                <?php
                                
                            }
                        
                        ?>
                        
                    </div>

    <!-- Food Search Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill out to add the item(s) to your cart.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend class="text-white">Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                        //Check whether the image is available or not
                        if($image_name=="")
                        {
                            //Image not available
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Image is available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                            <?php
                        }
                        
                        ?>

                    </div>
    
                    <div class="food-order-desc">
                        <h3 class="text-white"><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <input type="hidden" name="session" value="<?php echo session_id(); ?>">

                        <p class="food-price text-white"><?php echo $price; ?></p>

                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <p class="food-detail text-white"><?php echo $description; ?></p>
                        <br>

                        <p class="food-quantity text-white">Available: <?php echo $quantity; ?></p>
                        <br>
                        <div class="order-label text-white">Quantity</div>

                        <input type="number" name="qty" class="input-responsive" value="1" min=1 max=<?php echo $quantity; ?> required>
                        <br>
                        <input type="submit" name="submit" value="Add" class="btn btn-primary">
                    </div>

                </fieldset>
                

            </form>

            <?php 
            
                //Check whether the submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Get all the details from the form

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $cookie = $_POST['session'];
                    $total = $price * $qty; //total = price x qty
                    $image = "$image_name";

                    $status = "Added"; //Add order

                    //Save the order in database, create SQL to save the data
                    $sql2 = "INSERT INTO tbl_cart SET 
                        food = '$food',
                        food_id = '$food_id',
                        code = '$cookie',
                        price = $price,
                        quantity = $qty,
                        image = '$image',
                        status = '$status'
                    ";  


                    $sql3 = "SELECT id, food, quantity FROM tbl_cart WHERE code='$cookie' AND food_id='$food_id' and status='Added'";
                                        
                    $res3 = mysqli_query($conn, $sql3);

                    $data = mysqli_fetch_array($res3);

                    $cart_id = $data['id'];
                    $cart_food = $data['food'];
                    $quantity = $data['quantity'];
                    $newQuantity = $quantity + $qty;

                    $sql4 = "UPDATE tbl_cart SET quantity=$newQuantity WHERE id=$cart_id";

                    if($cart_food!==$food)
                    {

                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        //Query executed and order saved
                        $_SESSION['order'] = "<div class='success text-center'>Added to cart.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Failed to save order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to add to cart.</div>";
                        header('location:'.SITEURL);
                    }
                }
                else
                {
                    $res4 = mysqli_query($conn, $sql4);

                    //Check whether query executed successfully or not
                    if($res4==true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<section class='success notifcontainer text-center text-white btn-bigtext'><h1>Added to cart.</h1></section>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<section class='success notifcontainer text-center text-white btn-bigtext'><h1>Failed to add to cart.</h1></section>";
                        header('location:'.SITEURL);
                    }
                }


            }
            ?>


        </div>
    </section>
        </section>
    <!-- Food Search Section Ends Here -->

    <!-- help button -->

<h1 class="text-right"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1mGES2UeDcJGL7qm5UHArVXgkMC_2fo96/edit#bookmark=id.j9cc8zpmvg5p" class="float btn-primary btn btn-bigtext">Help</a></h1>


    <?php include('partials-front/footer.php'); ?>  