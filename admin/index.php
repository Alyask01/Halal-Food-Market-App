
<?php include('partials/menu.php'); ?> 

      <!-- Main Content Section Starts -->
      <div class="main-content">
         <div class="wrapper">
               <h1>Dashboard</h1>
               <br><br>
               <?php
                  if(isset($_SESSION['login']))
                  {
                     echo $_SESSION['login'];
                     unset($_SESSION['login']);
                  }
               ?>
               <?php
                  if(isset($_SESSION['reset'])){
                     echo $_SESSION['reset'];
                     unset($_SESSION['reset']);
                  }
               ?>

               <br><br>

               <div class="col-4 text-center">

                  <?php 
                     //SQL Query
                     $sql = "SELECT * FROM tbl_category";
                     //Execute the Query
                     $res = mysqli_query($conn, $sql);
                     //Count Rows
                     $count = mysqli_num_rows($res);
                  ?>
                  
                  <h1><?php echo $count; ?></h1>
                  <br />
                  Categories
               </div>

               <div class="col-4 text-center">

                  <?php 
                     //SQL Query
                     $sql2 = "SELECT * FROM tbl_food";
                     //Execute the Query
                     $res2 = mysqli_query($conn, $sql2);
                     //Count Rows
                     $count2 = mysqli_num_rows($res2);
                  ?>

                  <h1><?php echo $count2; ?></h1>
                  <br />
                  Foods
               </div>

               <div class="col-4 text-center">

                  <?php 
                     //SQL Query
                     $sql3 = "SELECT * FROM tbl_order";
                     //Execute the Query
                     $res3 = mysqli_query($conn, $sql3);
                     //Count Rows
                     $count3 = mysqli_num_rows($res3);
                  ?>

                  <h1><?php echo $count3; ?></h1>
                  <br />
                  Total Orders
               </div>

               <div class="col-4 text-center">

                  <?php 
                     //Create SQL Query to get total revenue generated
                     //Aggregate Function in SQL
                     $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Completed'";

                     //Execute the Query
                     $res4 = mysqli_query($conn, $sql4);

                     //Get the value
                     $row4 = mysqli_fetch_assoc($res4);

                     //Get the Total Revenue
                     $total_revenue = $row4['Total'];
                  ?>
                  <h1>$<?php echo $total_revenue; ?></h1>
                  <br />
                  Revenue
               </div>
               
               <form method="GET" action="reset-revenue.php">
                  <button type="submit" name="reset" class="btn btn-danger">Reset Revenue</button>
               </form>



               <div class="clearfix"></div>

         </div>
      </div>
      <!-- Main Content Section Ends -->

      <!-- help button -->

<h1 class="text-right2"><a target="_blank" rel="noopener noreferrer" href="https://docs.google.com/document/d/1cY0h-OsaCbyn3-bs2xZfKClDxOf_-4F0/edit#bookmark=id.ab95ohvanqpu" class="float2 btn-primary2 btn2 btn-bigtext">Help</a></h1>

<?php include('partials/footer.php')?>