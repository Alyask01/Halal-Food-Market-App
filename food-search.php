<?php include('partials-front/menu.php'); ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
            
                //Get the search keyword
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            
            ?>
            
            <h2 class="text-white">Foods Matching Your Search "<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                //SQL query to get foods based on search keyword
                //SELECT * FROM tbl_food WHERE title LIKE '%%' OR description LIKE '%%';
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether food available or not
                if($count>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $quantity = $row['quantity'];
                        $image_name =$row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //Check whether image name is available or not
                                    if($image_name=="")
                                    {
                                        //Image not available
                                        echo "<div class='error>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image available
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

                                <?php if ($quantity <= 0) { ?>
                                    <p class="text-danger">Out of Stock</p>
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
                    //food not available
                    echo "<div class='error'>Food not Found.</div>";
                }
            
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Food Menu Section Ends Here -->

    <!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1cQJFlI_GZTkwLFA9vq1wSzISW6EPIzEY/edit#bookmark=id.htw5j2ezcj2q" class="float btn-primary btn btn-bigtext">Help</a></h1>


    
    <?php include('partials-front/footer.php'); ?>
