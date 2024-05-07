<?php

// Config.php file is included here
include('../connection/config.php');

// ID to delete of admin
$id = $_GET['id'];

// SQL query to delete the admin
$sql = "DELETE FROM admin_table WHERE id=$id";

// Query to execute
$res = mysqli_query($conn, $sql);

// Check if the query is executed
if($res==true)
{
  // Query is executed and the admin is deleted
  // Check if the query is executed
  if($res==true)
  {
    // Delete admin is successful
    // Create session to display the message
    $_SESSION['delete'] = "<div class='successful'>✔️ Delete Admin Successful!</div>";
    // Redirect page to admin_manage.php
    header("location:".HOME. 'admin/admin_manage.php'); }
    else {
      // Delete admin has failed
      // Create session to display the message
      $_SESSION['delete'] = "<div class='failed'>❌ Delete Admin Failed!</div>";
      // Redirect page to admin_manage.php
      header("location:".HOME. 'admin/admin_manage.php');
    }
  }

  ?>
