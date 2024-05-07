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

    <h1 class="text_center">Food Management</h1>

    <br />
    <br />

    <!-- Add the refresh button --->
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="button11">🔄 Refresh</a>

    <!-- Add the admin button --->
    <a href="food_add.php" class="button1">🍽️ Add</a>

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

    if(isset($_SESSION['upload'])) {
      echo $_SESSION['upload']; // Display the session message
      unset($_SESSION['upload']); // Remove the session message
    }

    if(isset($_SESSION['no_access'])) {
      echo $_SESSION['no_access']; // Display the session message
      unset($_SESSION['no_access']); // Remove the session message
    }

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
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Action</th>
      </tr>

      <?php
      // Get all the food query
      $sql = "SELECT * FROM food_table";
      // Execute the query
      $res = mysqli_query($conn, $sql);
      // Count the rows to check data
      $count = mysqli_num_rows($res); // Get all rows function

      // Check the number of rows
      if($count > 0) {
        // Data is in the database
        while($rows=mysqli_fetch_assoc($res)) {
          // Get the food data
          $id=$rows['id'];
          $category=$rows['category'];
          $title=$rows['title'];
          $price=$rows['price'];
          $image_name=$rows['image_name'];
          $featured=$rows['featured'];

          // Display the data in table
          ?>
          <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $category;?></td>
            <td><strong><?php echo $title;?></strong></td>
            <td>£<?php echo $price;?></td>

            <td>
              <?php
              // Check if the image is available
              if($image_name!="")
              {
                // Display the image
                ?>
                <img src="<?php echo HOME; ?>images/food_images/<?php echo $image_name; ?>" width="125px" height="125px" border=2.5px solid black;"">
                <?php

              }
              ?>
            </td>

            <td>
              <?php
              if($featured=="Yes") {
                echo "<label style='color: #44bd32'><strong>$featured</strong></label>";
              }
              elseif($featured=="No") {
                echo "<label style='color: #c23616'><strong>$featured</strong></label>";
              }
              ?>
            </td>

            <td>
              <a href="<?php echo HOME; ?>admin/food_update.php?id=<?php echo $id;?>" class="button2">✏️ Update Food</a>
              <a href="#" class="button3 delete_food_button" data_id="<?php echo $id;?>&image_name=<?php echo $image_name;?>">🗑️ Delete Food</a>
            </td>
          </tr>
          <?php
        }
      }

      else {
        // Data is not in the database
        ?>
        <tr>
          <td colspan="7"><h4 class='failed text_center'>❌ Display Food Failed! ⚠️ No Food Added! 🔁 Click The "Add Food" Button!</h4></td>
        </tr>
        <?php
      }
      ?>

    </table>

    <!-- Confirmation popup -->
    <div class="confirmation_popup" id="deleteConfirmation" style="display: none;">
      <h2>⚠️ Confirm Delete</h2>
      <br />
      <h4 class="text_center"><strong>Delete Food: <?php echo $title;?></strong></h4>
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
  const deleteFoodButtons = document.querySelectorAll(".delete_food_button");
  const confirmationPopup = document.getElementById("deleteConfirmation");
  const confirmDeleteButton = document.getElementById("confirmDeleteButton");
  const cancelDeleteButton = document.getElementById("cancelDeleteButton");
  const overlay = document.getElementById("overlay");

  deleteFoodButtons.forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      confirmationPopup.style.display = "block";
      overlay.style.display = "block";
      confirmDeleteButton.setAttribute("data_id", button.getAttribute("data_id"));
    });
  });

  confirmDeleteButton.addEventListener("click", function () {
    const foodId = confirmDeleteButton.getAttribute("data_id");
    if (foodId) {
      window.location.href = `food_delete.php?id=${foodId}`;
    }
    confirmationPopup.style.display = "none";
    overlay.style.display = "none";
  });

  cancelDeleteButton.addEventListener("click", function () {
    confirmationPopup.style.display = "none";
    overlay.style.display = "none";
  });
});
</script>

<?php include('../includes/admin_footer.php');?>
