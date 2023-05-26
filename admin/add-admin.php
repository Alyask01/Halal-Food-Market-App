<?php include('partials/menu.php'); ?>

<div class ="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //Checking whther the session is set or not
            {
                echo $_SESSION['add']; //display session message
                unset($_SESSION['add']); //remove session message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name=" full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type ="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table> 

        </form>
    


    </div>     
</div>

<?php include('partials/footer.php'); ?>


<?php
    //Process the value from Form and Save it in a Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //Button Not Clicked

        //Get Data From Form (use Echo to check)
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5

        //SQL Query to save data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //Execute Query and Save Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Check whether the  (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data Inserted
            //Echo"Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class ='success'>Admin Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Insert Data
            //Echo"failed";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "Failed to Add Admin";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }

    }

    

?>

<!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/10tpNLzBUP54K3xahZqUFklJkXQmxqlgB/edit#bookmark=id.vx0pdxfb5u35" class="float2 btn-primary2 btn2 btn-bigtext">Help</a></h1>
