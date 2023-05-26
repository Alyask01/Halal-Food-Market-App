<?php include('partials-front/menu.php'); ?>



    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

     <!-- notifications for adding to cart -->
     <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }

        if(isset($_SESSION['order_submitted']))
        {
            echo $_SESSION['order_submitted'];
            unset($_SESSION['order_submitted']);
        }
        ?>

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }

        if(isset($_SESSION['order_submitted']))
        {
            echo $_SESSION['order_submitted'];
            unset($_SESSION['order_submitted']);
        }
    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                //Create SQL Query to Display Categories from Database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'LIMIT 3";
                //Execute the Query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Check whether image is available or not
                                    if($image_name=="")
                                    {
                                        //Display Message
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" height=100% class="img-zoom img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Categories not available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>




            <div class="clearfix"></div>
        </div>
    </section> 
    <!-- Categories Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Halal Food Market Best Sellers</h2>

            <?php 
            
                //Getting foods from database that are active and featured
                //SQL Query
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //Count rows
                $count2 = mysqli_num_rows($res2);

                //Check whether food available or not
                if($count2>0)
                {
                    //Food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //Get all the values
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
                                        echo "<div class='error'>Image not Available.</div>";
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
                                <?php if($quantity>0){ ?>
                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                <?php } ?>

                                <?php if($quantity==0){ ?>
                                    <p class=""><i>Out of Stock</i></p>
                                <?php } ?>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Food not available
                    echo "<div class='error'>Food not available.</div>";
                }
            
            ?>


           

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- Food Menu Section Ends Here -->

    <!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1MdYeT319SN3PcXAUQJUizuHC0gIGbPth/edit#bookmark=id.tjzol3yuzdin" class="float2 btn-primary2 btn2 btn-bigtext">Help</a></h1>


    <?php include('partials-front/footer.php'); ?>
    
