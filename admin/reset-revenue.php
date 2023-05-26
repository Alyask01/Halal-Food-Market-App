<?php
    include('../config/constants.php');

    if(isset($_GET['reset'])){
        $sql = "UPDATE tbl_order SET total = 0 WHERE status='Completed'";
        $res = mysqli_query($conn, $sql);

        if($res == true){
            $_SESSION['reset'] = "<div class='success'>Revenue has been reset successfully.</div>";
        }
        else{
            $_SESSION['reset'] = "<div class='error'>Failed to reset revenue.</div>";
        }
        
        header('location:'.SITEURL.'admin/index.php');
        exit;
    }
    else{
        header('location:'.SITEURL.'admin/index.php');
        exit;
    }
?>
