<?php
include('partials/menu.php');

//Check whether the id parameter is set in the URL
if(isset($_GET['id']))
{
    //Get the id and delete the order
    $id = $_GET['id'];

    //Create SQL query to delete order
    $sql = "DELETE FROM tbl_order WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the query was successful
    if($res==true)
    {
        //Query executed successfully and order deleted
        $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    else
    {
        //Failed to delete order
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Order. Please Try Again.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
}
else
{
    //Redirect to manage-order.php
    header('location:'.SITEURL.'admin/manage-order.php');
}
?>
