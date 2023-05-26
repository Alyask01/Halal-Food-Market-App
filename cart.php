    <?php include('partials-front/menu.php'); ?>

    <!-- help button -->
<!-- <h1 class="text-center"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1AtsSNrV_OuEIPIp5HL1yXguoilEn41dg/edit#bookmark=id.xes3dcafx6nz" class="float btn-primary btn btn-bigtext">Help</a></h1> -->



    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Cart</h2>

            <?php 
            
                //Create SQL Query to Get foods based on Selected CAtegory
                $sessionToken = session_id();

                $sql = "SELECT * FROM tbl_cart WHERE code='$sessionToken' AND status='Added'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the Rows
                $count = mysqli_num_rows($res);

                //Check whether food is available or not
                if($count>0)
                {
                    //Retrieve items added to cart
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['food'];
                        $food_id = $row['food_id'];
                        $price = $row['price'];
                        $quantity = $row['quantity'];
                        $image_name = $row['image'];
                        ?>

                        <form action="" method="POST" class="tbl-full">
                            <fieldset>
                                <div class="food-menu-img">
                                    <?php 
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image not Available.</div>";
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>

                                <!-- get food items' details -->
                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>                                    
                                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                                    <p class="food-price">$<?php echo $price; ?></p></p>
                                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                                    
                                    <input type="hidden" name="cart_id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                                    
                                    <p class="food-quantity">Available: <?php 
                                                $sql3 = "SELECT quantity FROM tbl_food WHERE id=$food_id";
                                                $result = mysqli_query($conn, $sql3);
                                                $data = mysqli_fetch_array($result);
                                                $max_quantity = $data['quantity'];
                                                echo $max_quantity;?>
                                                </p>

                                    <div class="order-label">Quantity </div>
                                    
                                    <input type="number" name="qty" class="input-responsive" value=<?php echo $quantity; ?> min=1 max=<?php echo $max_quantity; ?> required>
                                    
                                    <div class="order-label">Cost : $<?php $cost = $price * $quantity; 
                                    echo number_format((float)$cost, 2, '.', '');?></div>
                                    <input type="hidden" name="total" value="<?php $cost = $price * $quantity; 
                                    echo $cost;?>">

                                    <input type="submit" name="update" value="Update" class="btn btn-primary">
                                    <input type="submit" name="delete" value="Delete" class="btn btn-primary">
                                </div>
                            </fieldset>
                        </form>
                        <?php

                            // update item in cart
                            if(isset($_POST['update']))
                            {
                                $id = $_POST['cart_id'];
                                $qty = $_POST['qty'];
                                $total = $price * $qty;
                                $sql3 = "UPDATE tbl_cart SET quantity=$qty WHERE id=$id"; 
                                $res3 = mysqli_query($conn, $sql3);
                                
                                if($res3==true)
                                {
                                    header("Refresh:0, url=/food-order/cart.php",TRUE,301);
                                    exit();
                                }
                                else
                                {
                                    header("Refresh:0, url=/food-order/cart.php",TRUE,301);
                                    exit();
                                } 
                            } 
                           
                            // delete item from cart
                            if(isset($_POST['delete']))
                            {
                                $id = $_POST['cart_id'];
                                $sql6 = "DELETE FROM tbl_cart WHERE id=$id"; 
                                $res6 = mysqli_query($conn, $sql6);  
                                
                                if($res6==true)
                                {
                                    header("Refresh:0, url=/food-order/cart.php",TRUE,301);
                                    exit();
                                }
                                else
                                {
                                    header("Refresh:0, url=/food-order/cart.php",TRUE,301);
                                    exit();
                                } 
                            }
                    }
                }
                else
                {
                    echo "<div class='error'>Cart is empty.</div>";
                }
            ?>



            <hr>
            <br><br>
            <h2 class="text-center">Fill out this form to confirm your order.</h2>

            <!-- form for customers to fill out order details -->
            <form action="" method="POST" class="order" >
                <fieldset>
                    <legend>Order Details</legend>
                    <div class="order-label">Full Name</div>

                    <input type="hidden" name="session" value="<?php echo session_id(); ?>">
                    <input type="text" name="full-name" placeholder="E.g. John Smith" class="input-responsive" pattern="[A-Za-z ]+"  required>
                    
                    <div class="order-label">Phone Number</div>
                    
                    <input type="tel" name="contact" placeholder="E.g. 636-423-2213" class="input-responsive" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                    
                    <div class="order-label">Email</div>
                    
                    <input type="email" name="email" placeholder="E.g. example@email.com" class="input-responsive" required>
                    
                    <div class="order-label">Order Details</div>
                    
                    <textarea name="details" rows="10" placeholder="Customize your order and provide your intended pickup time and date" class="input-responsive" required></textarea>

                    <!-- get subtotal by taking price*quantity for each item in cart -->
                    <p class="order-label">Order Subtotal (taxes & fees not included): $<?php  
                                    $sql4 = "SELECT SUM(price * quantity) as total_price FROM tbl_cart WHERE code='$sessionToken'AND status='Added'";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row2 = mysqli_fetch_array($res4);
                                    $cost = $row2['total_price'];
                                    echo $cost;?>
                                    </p>
                    <input type="hidden" name="cost" value="<?php $sql4 = "SELECT SUM(price * quantity) as total_price FROM tbl_cart WHERE code='$sessionToken' AND status='Added'";
                                    $res4 = mysqli_query($conn, $sql4);
                                    $row2 = mysqli_fetch_array($res4);
                                    $cost = $row2['total_price'];
                                    echo $cost; ?>">
                    <br>
                    <input href="<?php echo SITEURL; ?>" type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>

            <div class="clearfix"></div>
            
            <!-- submit order (adds to order table in the database) -->
            <?php 
                if(isset($_POST['submit']) AND ($count>0)){
			// include('mail.php');


                    // get order details
                    $total = $_POST['cost'];
                    $cart_id = $_POST['session'];
                    $order_date = date("Y-m-d h:i:sa"); 
                    $status = "Ordered";
                    $dirty_customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $dirty_customer_details = $_POST['details'];

                    // remove special chars that could perform injection
                    $clean_customer_name = htmlspecialchars($dirty_customer_name);
                    $clean_customer_details = htmlspecialchars($dirty_customer_details);

                    // insert order into orders table
                    $sql2 = "INSERT INTO tbl_order SET 
                        total = $total,
                        cart_id = '$cart_id',
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$clean_customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_details = '$clean_customer_details'
                    ";

                    $res2 = mysqli_query($conn, $sql2); 

                    $sql7 = "SELECT id FROM tbl_order WHERE cart_id='$cart_id' ORDER BY order_date DESC";
                    $res7 = mysqli_query($conn, $sql7);
                    $row7 = mysqli_fetch_array($res7);
                    $order_id = $row7['id'];  

                    if($res2 == true)
                    // redirects to homepage with notification of success
                    {
                        
                        
                        $sql5 = "UPDATE tbl_cart SET 
                        status = '$status',
                        order_id = '$order_id'
                        WHERE code='$cart_id' AND status='Added'
                    ";

                        $res5 = mysqli_query($conn, $sql5);

                        // remove qty ordered from food table
                        $sql8 = "SELECT food_id, quantity FROM tbl_cart WHERE order_id='$order_id'";
                        $res8 = mysqli_query($conn, $sql8);
                        $count8 = mysqli_num_rows($res8);
                        if($count8>0)
                        {
                                while($row8=mysqli_fetch_assoc($res8))
                                {
                                $cart_qty = $row8['quantity'];
                                $cart_food_id = $row8['food_id'];

                                $sql9 = "SELECT quantity FROM tbl_food WHERE id=$cart_food_id";
                                $res9 = mysqli_query($conn, $sql9);
                                $data2 = mysqli_fetch_array($res9);
                
                                $food_quantity = $data2['quantity'];
                                $newQuantity = $food_quantity - $cart_qty;
                
                                $sql10 = "UPDATE tbl_food SET 
                                    quantity = $newQuantity
                                    WHERE id=$cart_food_id
                                "; 

                                $res10 = mysqli_query($conn, $sql10);
                                
                                }
                            } 
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

                            echo "<script> location.href='index.php';</script>";
                            $_SESSION['order_submitted'] = "<section class='success notifcontainer text-center text-white btn-bigtext'><h1>				Order submitted!</h1></section>";
                            header('location:'.SITEURL);
                            require 'mail.php';
                        }
                        else
                        {
                            echo "<script> location.href='index.php'; </script>";
                            $_SESSION['order_submitted'] = "<section class='error notifcontainer text-center text-white btn-bigtext'><h1>Order failed to submit.</h1></section>";
                            header('location:'.SITEURL);
                            exit;
                        }
                    }
                }
            ?>
	
        </div>

    </section>

<!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1mGES2UeDcJGL7qm5UHArVXgkMC_2fo96/edit#bookmark=id.wuu1i8754ekw" class="float btn-primary btn btn-bigtext">Help</a></h1>



    <?php include('partials-front/footer.php'); ?>