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

    <h1 class="text_center">Admin Management</h1>

    <br />
    <br />

    <!-- Add the refresh button --->
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="button11">🔄 Refresh</a>

    <!-- Add the admin button --->
    <a href="admin_add.php" class="button1">👤 Add</a>

    <br />
    <br />
    <br />

    <?php
    if(isset($_SESSION['add'])) {
      echo $_SESSION['add']; // Display the session message
      unset($_SESSION['add']); // Remove the session message
    }

    if(isset($_SESSION['delete'])) {
      echo $_SESSION['delete']; // Display the session message
      unset($_SESSION['delete']); // Remove the session message
    }

    if(isset($_SESSION['no_password_found'])) {
      echo $_SESSION['no_password_found']; // Display the session message
      unset($_SESSION['no_password_found']); // Remove the session message
    }

    if(isset($_SESSION['wrong_password'])) {
      echo $_SESSION['wrong_password']; // Display the session message
      unset($_SESSION['wrong_password']); // Remove the session message
    }

    if(isset($_SESSION['reset_password'])) {
      echo $_SESSION['reset_password']; // Display the session message
      unset($_SESSION['reset_password']); // Remove the session message
    }
    ?>

    <br />

    <table class="full_table">
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Manage Admin</th>
      </tr>

      <?php
      // Get all the admin queries
      $sql = "SELECT * FROM admin_table";
      // Execute the query
      $res = mysqli_query($conn, $sql);
      // Check if the query is executed
      if($res == TRUE) {
        // Count the rows to check data
        $count = mysqli_num_rows($res); // Get all rows function

        // Check the number of rows
        if($count > 0) {
          // Data is in the database
          $row_counter = 0;

          while($rows=mysqli_fetch_assoc($res)) {
            // Get all data using the while loop
            // Data in database is needed for the while loop to run

            // Get the user data
            $id=$rows['id'];
            $full_name=$rows['full_name'];
            $username=$rows['username'];

            // Set up the row counter
            $row_counter++;

            ?>

            <tr>
              <td><strong><?php echo $id; ?></strong></td>
              <td><?php echo $full_name;?></td>
              <td><strong><?php echo $username;?></strong></td>
              <td>
                <?php if($row_counter > 1) { ?>
                  <a href="<?php echo HOME; ?>admin/admin_reset.php?id=<?php echo $id;?>" class="button2">🔑 Reset Password</a>
                  <!-- Delete admin button with confirmation popup -->
                  <a href="#" class="button3 delete_admin_button" data_id="<?php echo $id; ?>">🗑️ Delete Admin</a>
                <?php } ?>
              </td>
            </tr>

            <?php
          }
        }
        else {
          // Data is not in the database
          ?>
          <tr>
            <td colspan="4"><h4 class='failed text_center'>❌ Display Admins Failed! ⚠️ No Admins Added! 🔁 Click The "Add Admin" Button!</h4></td>
          </tr>
          <?php
        }
      }

      ?>

    </table>

    <!-- Confirmation popup -->
    <div class="confirmation_popup" id="deleteConfirmation">
      <h2>⚠️ Confirm Delete</h2>
      <br />
      <h4 class="text_center"><strong>Delete Admin: <?php echo $username;?></strong></h4>
      <br />
      <h4 class="text_center">Are you sure you want to delete? You cannot undo this!</h4>
      <div class="button_container">
        <button id="cancelDeleteButton" class="button3">❌ Cancel</button>
        <button id="confirmDeleteButton" class="button1">✔️ Confirm</button>
      </div>
    </div>

    <br />
    <br />
    <br />

  </div>
</div>
<!-- Main content ends here -->

<!-- JavaScript for delete confirmation popup -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const deleteAdminButtons = document.querySelectorAll(".delete_admin_button");
  const confirmationPopup = document.getElementById("deleteConfirmation");
  const confirmDeleteButton = document.getElementById("confirmDeleteButton");
  const cancelDeleteButton = document.getElementById("cancelDeleteButton");
  const overlay = document.getElementById("overlay"); // Get the overlay element

  deleteAdminButtons.forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      confirmationPopup.style.display = "block";
      overlay.style.display = "block"; // Show the overlay
      confirmDeleteButton.setAttribute("data_id", this.getAttribute("data_id"));
    });
  });

  confirmDeleteButton.addEventListener("click", function () {
    const adminId = confirmDeleteButton.getAttribute("data_id");
    if (adminId) {
      window.location.href = "admin_delete.php?id=" + adminId;
    }
    confirmationPopup.style.display = "none";
    overlay.style.display = "none"; // Hide the overlay
  });

  cancelDeleteButton.addEventListener("click", function () {
    confirmationPopup.style.display = "none";
    overlay.style.display = "none"; // Hide the overlay
  });
});
</script>


<?php include('../includes/admin_footer.php');?>
