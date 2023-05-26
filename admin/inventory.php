<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Inventory</h1>

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
                <th>S.N.</th>
                <th>Food</th>
                <th>Food Image</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>

            <?php 
                // Get all the food items from the database
                $sql = "SELECT id, title, image_name, quantity FROM tbl_food";
                // Execute the query
                $res = mysqli_query($conn, $sql);

                if($res)
                {
                    // Check if the query executed successfully
                    $count = mysqli_num_rows($res);

                    if($count > 0)
                    {
                        // Food items available
                        $sn = 1; // Initialize the serial number
                        while($row=mysqli_fetch_assoc($res))
                        {
                            // Get food item details
                            $id = $row['id'];
                            $title = $row['title'];
                            $current_image = $row['image_name'];
                            $quantity = $row['quantity'];
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php
                                    if (!empty($current_image)) {
                                        $image_path = SITEURL . 'images/food/' . $current_image; // Replace 'images/food/' with the actual directory where your food images are stored
                                        echo "<img src='$image_path' alt='Food Image' class='img-responsive' width='100px' height='100px' />";
                                    } else {
                                        echo "No Image Available";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <form method="post" action="">
                                        <input type="number" name="quantity_<?php echo $id; ?>" value="<?php echo $quantity; ?>" />
                                </td>
                                <td>
                                    <input type="submit" name="submit_<?php echo $id; ?>" value="Update" class="btn-secondary" />
                                    </form>
                                    <?php
                                    if(isset($_POST['submit_'.$id])) {
                                        // Check if the submit button for this food item was clicked
                                        $newQuantity = $_POST['quantity_'.$id]; // Get the updated quantity from the submitted form data
                                        
                                        // Update the quantity in the database
                                        $updateSql = "UPDATE tbl_food SET quantity = '$newQuantity' WHERE id = '$id'";
                                        $updateRes = mysqli_query($conn, $updateSql);
                                        
                                        if($updateRes) {
                                            // Quantity updated successfully
                                            $_SESSION['update'] = "<div class='success'>Quantity updated successfully.</div>";
                                            header('location:'.SITEURL.'admin/inventory.php');
                                        } else {
                                            // Failed to update quantity
                                            $_SESSION['update'] = "<div class='error'>Failed to update quantity.</div>";
                                            header('location:'.SITEURL.'admin/inventory.php');
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        // Food items not available
                        echo "<tr><td colspan='5' class='error'>Food items not available.</td></tr>";
                    }
                }
                else
                {
                    // Failed to execute query
                    echo "<tr><td colspan='5' class='error'>Failed to fetch food items.</td></tr>";
                }
            ?>
                
        </table>
    </div>
</div>

<!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1d71vHGTfRT1Z694AzDfpERUBLp5ahOfK/edit#bookmark=id.6t4qzca4c55v" class="float2 btn-primary2 btn2 btn-bigtext">Help</a></h1>


<?php include('partials/footer.php'); ?>
