<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            
                //Display all the categories that are active
                //SQL Query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether categories available or not
                if($count>0)
                {
                    //Categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Image not available
                                        echo "<div class='error'>Image not Found.</div>";
                                    }
                                    else
                                    {
                                        //Image available
                                        ?>
                           <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" class="img-zoom img-curve">
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
                    echo "<div class='error'>Category not Found.</div>";
                }
            
            ?>




            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>

    <!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1ydAFxuGYje5llkhWcy9uOUqxUxXVqcx1/edit#bookmark=id.ff6vf6hpnmos" class="float btn-primary btn btn-bigtext">Help</a></h1>



</body>
</html>