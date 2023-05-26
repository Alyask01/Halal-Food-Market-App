<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Halal Food Market Menu</h2>

            <?php 
                //Display foods that are active
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether the foods are available or not
                if($count>0)
                {
                    //Foods available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $quantity = $row['quantity'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //Check whether image available or not
                                    if($image_name=="")
                                    {
                                        //Image not available
                                        echo "<div class ='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
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

                                <?php if ($quantity <= 0) { ?>
                                    <p class="food-stock">Out of Stock</p>
                                <?php } else { ?>
                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                <?php } ?>
                            </div>
                        </div>

                        <?php
                        
                    }
                }
                else
                {
                    //Food not available
                    echo "<div class='error>Food not found.</div>";
                }
            ?>



            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Food Menu Section Ends Here -->

    <!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1u_eiQZ5EgCevNzMl3XQHIdQeQy7ILSFo/edit#bookmark=id.m0v6gdjun6me" class="float btn-primary btn btn-bigtext">Help</a></h1>


    <?php include('partials-front/footer.php'); ?>
