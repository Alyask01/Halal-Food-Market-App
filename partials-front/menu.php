<?php include('config/constants.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alhuda 2 Market | Home</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <img src="images/halallogo.png" alt="Restaurant Logo with Halal" width=75% height=75%>
                </a>
            </div>
            

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="tel:3142561807">Call (314) 256-1807 | Hours - 9:00am to 9:00pm</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                   
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>grocery.php">Grocery</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>about.php">About</a>
                    <li>
                        <a href="<?php echo SITEURL; ?>cart.php"><img src="images/cart-icon.png" height=25 width=25/> </a>
                    </li> 
                        <!-- this was the categories -->
                    </li>
                   
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
        <!-- Navbar Section Ends Here -->