<?php include('../includes/admin_header.php');?>

<!-- Main content starts here -->
<div class="main_content">
  <div class="wrapper">

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />

    <h1 class="text_center">Admin Dashboard</h1>

    <br />

    <div class="iframe_center">
      <iframe src="https://free.timeanddate.com/clock/i9ca5ar6/n297/tluk/fs20/tcdcdde1/pcdcdde1/ftb/tt0/ts1" frameborder="0" width="390" height="50" allowtransparency="true"></iframe>
    </div>

    <!-- Add the refresh button --->
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="button9">🔄 Refresh</a>

    <br />
    <br />
    <br />

    <?php
    // Check if the user is logged in
    if(isset($_SESSION['login'])) {
      // Display the login success message
      echo "<div class='successful'>" . $_SESSION['login'] . "</div>";
      unset($_SESSION['login']);
    }
    ?>

    <h3 class="text_center">System Statistics</h3>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql = "SELECT * FROM admin_table";
      // Execute the SQL query
      $res = mysqli_query($conn, $sql);
      // Count the rows
      $count = mysqli_num_rows($res);
      ?>
      <h2><?php echo $count ?></h2>

      <br/>
      Total Admins
    </div>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql2 = "SELECT * FROM food_table";
      // Execute the SQL query
      $res2 = mysqli_query($conn, $sql2);
      // Count the rows
      $count2 = mysqli_num_rows($res2);
      ?>
      <h2><?php echo $count2 ?></h2>

      <br/>
      Total Items
    </div>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql3 = "SELECT * FROM order_table";
      // Execute the SQL query
      $res3 = mysqli_query($conn, $sql3);
      // Count the rows
      $count3 = mysqli_num_rows($res3);
      ?>
      <h2><?php echo $count3 ?></h2>

      <br/>
      Total Orders
    </div>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql4 = "SELECT SUM(total) AS Total FROM order_table";
      // Execute the SQL query
      $res4 = mysqli_query($conn, $sql4);
      // Get the value
      $row4 = mysqli_fetch_assoc($res4);
      // Get the total revenue
      $total_revenue = $row4['Total'];
      ?>
      <h2>£<?php echo $total_revenue; ?></h2>
      <br/>
      Total Revenue
    </div>

    <h3 class="text_center">Food Statistics</h3>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql5 = "SELECT * FROM food_table WHERE category = 'Pizzas'";
      // Execute the SQL query
      $res5 = mysqli_query($conn, $sql5);
      // Count the rows
      $count5 = mysqli_num_rows($res5);
      ?>
      <h2><?php echo $count5 ?></h2>

      <br/>
      Total Pizzas
    </div>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql6 = "SELECT * FROM food_table WHERE category = 'Sides'";
      // Execute the SQL query
      $res6 = mysqli_query($conn, $sql6);
      // Count the rows
      $count6 = mysqli_num_rows($res6);
      ?>
      <h2><?php echo $count6 ?></h2>

      <br/>
      Total Sides
    </div>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql7 = "SELECT * FROM food_table WHERE category = 'Desserts'";
      // Execute the SQL query
      $res7 = mysqli_query($conn, $sql7);
      // Count the rows
      $count7 = mysqli_num_rows($res7);
      ?>
      <h2><?php echo $count7 ?></h2>

      <br/>
      Total Desserts
    </div>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql8 = "SELECT * FROM food_table WHERE category = 'Drinks'";
      // Execute the SQL query
      $res8 = mysqli_query($conn, $sql8);
      // Count the rows
      $count8 = mysqli_num_rows($res8);
      ?>
      <h2><?php echo $count8 ?></h2>

      <br/>
      Total Drinks
    </div>

    <h3 class="text_center">Order Statistics</h3>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql9 = "SELECT * FROM order_table WHERE status = 'Pending'";
      // Execute the SQL query
      $res9 = mysqli_query($conn, $sql9);
      // Count the rows
      $count9 = mysqli_num_rows($res9);
      ?>
      <h2><?php echo $count9 ?></h2>

      <br/>
      Total Pending
    </div>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql10 = "SELECT * FROM order_table WHERE status = 'Preparing'";
      // Execute the SQL query
      $res10 = mysqli_query($conn, $sql10);
      // Count the rows
      $count10 = mysqli_num_rows($res10);
      ?>
      <h2><?php echo $count10 ?></h2>

      <br/>
      Total Preparing
    </div>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql11 = "SELECT * FROM order_table WHERE status = 'Ready'";
      // Execute the SQL query
      $res11 = mysqli_query($conn, $sql11);
      // Count the rows
      $count11 = mysqli_num_rows($res11);
      ?>
      <h2><?php echo $count11 ?></h2>

      <br/>
      Total Ready
    </div>

    <div class="column_4 text_center">
      <?php
      // This is a SQL query
      $sql12 = "SELECT * FROM order_table WHERE status = 'Cancelled'";
      // Execute the SQL query
      $res12 = mysqli_query($conn, $sql12);
      // Count the rows
      $count12 = mysqli_num_rows($res12);
      ?>
      <h2><?php echo $count12 ?></h2>

      <br/>
      Total Cancelled
    </div>

    <div class="fix"></div>

    <br />
    <br />
    <br />

  </div>
</div>
<!-- Main content ends here -->

<?php include('../includes/admin_footer.php');?>
