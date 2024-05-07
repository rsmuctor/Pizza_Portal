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

    <h1 class="text_center">Order Management</h1>

    <br />

    <div class="iframe_center">
      <iframe src="https://free.timeanddate.com/clock/i9ca5ar6/n297/tluk/fs20/tcdcdde1/pcdcdde1/ftb/tt0/ts1" frameborder="0" width="390" height="50" allowtransparency="true"></iframe>
    </div>

    <!-- Add the refresh button --->
    <br/>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="button11">🔄 Refresh</a>

    <!-- Add the pending orders button --->
    <a href="order_manage_pending.php" class="button5">⏳ Pending</a>

    <!-- Add the preparing orders button --->
    <a href="order_manage_preparing.php" class="button6">🍽️ Preparing</a>

    <!-- Add the ready orders button --->
    <a href="order_manage_ready.php" class="button7">✔️ Ready</a>

    <!-- Add the cancelled orders button --->
    <a href="order_manage_cancelled.php" class="button8">🗑️ Cancelled</a>

    <br />
    <br />
    <br />

    <?php
    if(isset($_SESSION['update'])) {
      echo $_SESSION['update']; // Display the session message
      unset($_SESSION['update']); // Remove the session message
    }
    ?>

    <br />

    <table class="full_table">
      <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Food</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Status</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
        <th></th>
      </tr>

      <?php
      // Get all the orders query
      $sql = "SELECT * FROM order_table ORDER BY id DESC"; // Display the first latest order
      // Execute the query
      $res = mysqli_query($conn, $sql);
      // Count the rows to check the data
      $count = mysqli_num_rows($res); // Get all the rows function

      // Check the number of rows
      if($count > 0) {
        // Data is in the database
        while($rows=mysqli_fetch_assoc($res)) {
          // Get the food data
          $id=$rows['id'];
          $category=$rows['category'];
          $food=$rows['food'];
          $price=$rows['price'];
          $quantity=$rows['quantity'];
          $total=$rows['total'];
          $status=$rows['status'];
          $customer_name = $rows['customer_name'];
          $customer_email = $rows['customer_email'];
          ?>

          <tr>
            <td><strong><?php echo $id; ?></strong></td>
            <td><?php echo $category; ?></strong></td>
            <td><strong><?php echo $food; ?></td>
              <td>£<?php echo $price; ?></td>
              <td><strong><?php echo $quantity; ?></strong></td>
              <td>£<?php echo $total; ?></td>

              <td>
                <?php
                // Status includes pending, preparing, ready and cancelled
                if($status == "Pending") {
                  echo "<label style='color: #e1b12c'><strong>$status</strong></label>";
                } elseif($status == "Preparing") {
                  echo "<label style='color: #44bd32'><strong>$status</strong></label>";
                } elseif($status == "Ready") {
                  echo "<label style='color: #0097e6'><strong>$status</strong></label>";
                } elseif($status == "Cancelled") {
                  echo "<label style='color: #e84118'><strong>$status</strong></label>";
                }
                ?>
              </td>

              <td><?php echo $customer_name; ?></td>
              <td><?php echo $customer_email; ?></td>
              <td>
                <a href="<?php echo HOME; ?>admin/order_update.php?id=<?php echo $id;?>" class="button2">✏️ Update Order</a>
              </td>
            </tr>

            <?php
          }
        }
        else {
          // Data is not in the database
          ?>
          <tr>
            <td colspan="10"><h4 class='failed text_center'>❌ Display Orders Failed! ⚠️ No Orders Added!</h4></td>
          </tr>
          <?php
        }

        ?>
      </table>

      <br />
      <br />
      <br />

    </div>
  </div>
  <!-- Main content ends here -->

  <?php include('../includes/admin_footer.php');?>
