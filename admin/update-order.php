<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>


        <?php 
        
            //Check whether id is set or not
            if(isset($_GET['id']))
            {
                //Get the Order Details
                $id=$_GET['id'];

                //Get all other details based on this id
                //SQL Query to get order details
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Details Available
                    $row=mysqli_fetch_assoc($res);

                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_details = $row['customer_details'];
                }
                else
                {
                    //Details not Available
                    //Redirect to manage order
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                //Redirect to manage order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option> 
                            <option <?php if($status=="Preparing"){echo "selected";}?> value="Preparing">Preparing</option> <!-- change this to cooking -->
                            <option <?php if($status=="Completed"){echo "selected";}?> value="Completed">Completed</option> <!-- change this to ready for pickup -->
                            <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Details: </td>
                    <td>
                        <textarea name="customer_details" cols="30" rows="5"><?php echo $customer_details; ?></textarea> <!-- Change Address to customer details -->
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="startStatus" value="<?php echo $status; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>


        <?php 
            //Check whether update button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //Get all the values from form
                $id = $_POST['id'];
                $startStatus = $_POST['startStatus'];
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_details = $_POST['customer_details'];

                //Update the Values
                $sql2 = "UPDATE tbl_order SET
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_details = '$customer_details'
                    WHERE id=$id
                ";
if($status=="Cancelled" and $startStatus=="Ordered")
{
    $sql3 = "SELECT food_id, quantity FROM tbl_cart WHERE order_id='$id'";
    $res3 = mysqli_query($conn, $sql3);
    $count = mysqli_num_rows($res3);
        if($count>0)
        {
            while($row3=mysqli_fetch_assoc($res3))
            {
            $qty = $row3['quantity'];
            $food_id = $row3['food_id'];

            $sql4 = "SELECT quantity FROM tbl_food WHERE id=$food_id";
            $res4 = mysqli_query($conn, $sql4);
            $data = mysqli_fetch_array($res4);

            $quantity = $data['quantity'];
            $newQuantity = $quantity + $qty;

            $sql5 = "UPDATE tbl_food SET 
                quantity = $newQuantity
                WHERE id=$food_id
            "; 
            $res5 = mysqli_query($conn, $sql5);
        }
    }
}

if($status=="Completed" and $startStatus=="Cancelled")
{
    $sql3 = "SELECT food_id, quantity FROM tbl_cart WHERE order_id='$id'";
    $res3 = mysqli_query($conn, $sql3);
    $count = mysqli_num_rows($res3);
        if($count>0)
        {
            while($row3=mysqli_fetch_assoc($res3))
            {
            $qty = $row3['quantity'];
            $food_id = $row3['food_id'];

            $sql4 = "SELECT quantity FROM tbl_food WHERE id=$food_id";
            $res4 = mysqli_query($conn, $sql4);
            $data = mysqli_fetch_array($res4);

            $quantity = $data['quantity'];
            $newQuantity = $quantity - $qty;

            $sql5 = "UPDATE tbl_food SET 
                quantity = $newQuantity
                WHERE id=$food_id
            "; 
            $res5 = mysqli_query($conn, $sql5);
        }
    }
}

if($status=="Ordered" and $startStatus=="Cancelled")
{
    $sql3 = "SELECT food_id, quantity FROM tbl_cart WHERE order_id='$id'";
    $res3 = mysqli_query($conn, $sql3);
    $count = mysqli_num_rows($res3);
        if($count>0)
        {
            while($row3=mysqli_fetch_assoc($res3))
            {
            $qty = $row3['quantity'];
            $food_id = $row3['food_id'];

            $sql4 = "SELECT quantity FROM tbl_food WHERE id=$food_id";
            $res4 = mysqli_query($conn, $sql4);
            $data = mysqli_fetch_array($res4);

            $quantity = $data['quantity'];
            $newQuantity = $quantity - $qty;

            $sql5 = "UPDATE tbl_food SET 
                quantity = $newQuantity
                WHERE id=$food_id
            "; 
            $res5 = mysqli_query($conn, $sql5);
        }
    }
}

if($status=="Cancelled" and $startStatus=="Completed")
{
    $sql3 = "SELECT food_id, quantity FROM tbl_cart WHERE order_id='$id'";
    $res3 = mysqli_query($conn, $sql3);
    $count = mysqli_num_rows($res3);
        if($count>0)
        {
            while($row3=mysqli_fetch_assoc($res3))
            {
            $qty = $row3['quantity'];
            $food_id = $row3['food_id'];

            $sql4 = "SELECT quantity FROM tbl_food WHERE id=$food_id";
            $res4 = mysqli_query($conn, $sql4);
            $data = mysqli_fetch_array($res4);

            $quantity = $data['quantity'];
            $newQuantity = $quantity + $qty;

            $sql5 = "UPDATE tbl_food SET 
                quantity = $newQuantity
                WHERE id=$food_id
            "; 
            $res5 = mysqli_query($conn, $sql5);
        }
    }
}

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);
        

                //Check whether update or not
                //Redirect to manage order with message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>

    </div>
</div>

<!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1aTp9TWwFAKat7GEb1dwmQqRuyQCbbUR6/edit#bookmark=id.1ll9tjn9fnwp" class="float2 btn-primary2 btn2 btn-bigtext">Help</a></h1>

<?php include('partials/footer.php'); ?>