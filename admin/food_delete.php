<?php
// Config.php file is included here
include('../connection/config.php');

if (isset($_GET['id']) AND isset($_GET['image_name'])) {
  // ID and image name to delete of the food
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  // Check if the image is available and delete
  if ($image_name != "") {
    // Remove the image from folder
    $path = "../images/food_images/".$image_name;
    $remove = unlink($path);

    if ($remove==false) {
      // Remove the image failed
      $_SESSION['upload'] = "<div class='failed'>❌ Image Delete Failed!</div>";
      // Redirect the page to food_manage.php
      header("location:".HOME. 'admin/food_manage.php');
      // Stop the delete process
      die();
    }
  }

  // SQL query to delete the food
  $sql = "DELETE FROM food_table WHERE id=$id";

  // Query the execute
  $res = mysqli_query($conn, $sql);

  // Check if the query is executed
  if ($res==true) {
    // Delete food is successful
    // Create the session to display message
    $_SESSION['delete'] = "<div class='successful'>✔️ Delete Food Successful!</div>";
    // Redirect the page to food_manage.php
    header("location:".HOME. 'admin/food_manage.php');
  } else {
    // Delete food has failed
    // Create the session to display message
    $_SESSION['delete'] = "<div class='failed'>❌ Delete Food Failed!</div>";
    // Redirect the page to food_manage.php
    header("location:".HOME. 'admin/food_manage.php');
  }
} else {
  // Delete food no access
  // Create the session to display message
  $_SESSION['no_access'] = "<div class='failed'>❌ Delete Food Failed!</div>";
  // Redirect page to food_manage.php
  header("location:".HOME. 'admin/food_manage.php');
}
?>
