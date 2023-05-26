<?php
    // Include constants.php file here
    include('../config/constants.php');

    // 1. Get the ID of the Admin to be deleted
    $id = $_GET['id'];

    // 2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Get the total count of admins in the database
    $sql_count = "SELECT COUNT(*) as total FROM tbl_admin";
    $res_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_assoc($res_count);
    $total_admins = $row_count['total'];

    // Check if there is more than 1 admin in the database
    if ($total_admins > 1) {
        // Execute the Query
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed successfully
        if($res==true)
        {
            // Query Executed successfully and Admin Deleted
            // Create Session Variable to display message
            $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
            // Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            // Failed to Delete Admin
            $_SESSION['delete'] = "<div class ='error'>Failed to Delete Admin. Try Again Later.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    } else {
        // If there is only 1 admin left, show an error message
        $_SESSION['delete'] = "<div class ='error'>Cannot delete the last admin.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>
<!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/10tpNLzBUP54K3xahZqUFklJkXQmxqlgB/edit#bookmark=id.2gg5d26zevy" class="float2 btn-primary2 btn2 btn-bigtext">Help</a></h1>
