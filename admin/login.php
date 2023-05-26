<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1G9Usp9PYV4GL28NMiEKlAWsjA4AU-9gR/edit#bookmark=id.st59z4xcj8p7" class="float2 btn-primary2 btn2 btn-bigtext">Help</a></h1>

        <div class = "login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                     echo ($_SESSION['no-login-message']);
                    unset($_SESSION['no-login-message']);
                }

            ?>
            <br><br>

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="login" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Ends Here -->


            <p class="text-center">Created by - <a href="">Ascent Innovations</a></p>
        </div>

    </body>
</html>

<?php 

    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the data from login form (use echo do double check)
        //$username = $_POST['username'];
        //$password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        
        
        //2. Use SQL to check whether the user with username and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'" ;

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1) //There is atleast 1 available 
        {
            //User Available and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it

            //Redirect to Homepage/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User Not Available and Login Fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
            //Redirect to login page
            header('location:'.SITEURL.'admin/login.php');
        }

    }

?>
