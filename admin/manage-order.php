<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Order</h1>


            <br /> <br /> <br />

            <?php 
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <br><br>

            <table class="tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Details</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    //Get all the orders from database
                    $orders = 30;
                    $sql="SELECT * FROM tbl_order ORDER BY id DESC"; //Display latest order at first
                    //Execute the query
                    $res = mysqli_query($conn, $sql);
                    //Count the rows
                    $count = mysqli_num_rows($res);

                    $sn =1; //Create a serial number and set its initial value at 1

                    if($count>0)
                    {
                        //Order Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get all the order details
                            $id = $row['id'];
                            $total = $row['total'];
                            $cart_id = $row['cart_id'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_details = $row['customer_details'];

                            ?>
                                <tr>
                                <td><?php echo $id ?>. </td>
                                        <td><?php 
                                            $sql2 = "SELECT food FROM tbl_cart WHERE code='$cart_id' AND order_id='$id'";
                                            $res2 = mysqli_query($conn, $sql2);
                                            $count = mysqli_num_rows($res2);
                                                if($count>0)
                                                {
                                                    while($row2=mysqli_fetch_assoc($res2))
                                                    {
                                                    $food = $row2['food'];
                                                    print_r($food);?>
                                                    <br>
                                                    <?php
                                                    }
                                                }
                                            ?></td>
                                        <td>
                                            <?php
                                            $sql3 = "SELECT price FROM tbl_cart WHERE code='$cart_id' AND order_id='$id'";
                                            $res3 = mysqli_query($conn, $sql3);
                                            $p_count = mysqli_num_rows($res3);
                                                if($p_count>0)
                                                {
                                                    while($row3=mysqli_fetch_assoc($res3))
                                                    {
                                                    $price = $row3['price'];
                                                    print_r($price);?>
                                                    <br>
                                                    <?php
                                                    }
                                                }
                                            ?></td>
                                        <td><?php 
                                            $sql4 = "SELECT quantity FROM tbl_cart WHERE code='$cart_id' AND order_id='$id'";
                                            $res4 = mysqli_query($conn, $sql4);
                                            $q_count = mysqli_num_rows($res4);
                                                if($q_count>0)
                                                {
                                                    while($row4=mysqli_fetch_assoc($res4))
                                                    {
                                                    $quantity = $row4['quantity'];
                                                    print_r($quantity);?>
                                                    <br>
                                                    <?php
                                                    }
                                                }
                                            ?></td>
                                        <td>$<?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>


                                    <td>
                                        <?php
                                            //Ordered, On Delivery, Delivered, Cancelled. -Change Delivery options

                                            if($status=="Ordered")
                                            {
                                                echo "<label>$status</label>";
                                            }
                                            elseif($status=="Preparing")
                                            {
                                                echo "<label style='color: orange; '>$status</label>";
                                            }
                                            elseif($status=="Completed")
                                            {
                                                echo "<label style='color: green; '>$status</label>";
                                            }
                                            elseif($status=="Cancelled")
                                            {
                                                echo "<label style='color: red; '>$status</label>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_details; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update&nbsp;Order</a>
                                        
                                       <!-- <a href=" <?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Delete&nbsp;Order</a>  -->

                                    </td>
                                </tr>

                            <?php
                        }
                    }
                    else
                    {
                        //Order not available
                        echo "<tr><td colspan ='12' class='error'>Orders not Available.</td></tr>";
                    }
                ?>
                



            </table>
    </div>
    
</div>

<!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1aTp9TWwFAKat7GEb1dwmQqRuyQCbbUR6/edit?pli=1#bookmark=id.1ll9tjn9fnwp" class="float2 btn-primary2 btn2 btn-bigtext">Help</a></h1>


<?php include('partials/footer.php'); ?>