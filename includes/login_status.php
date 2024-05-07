<?php

// Control the access
// Check if the user is logged in
if(!isset($_SESSION['user'])) { // User session not active

  // User not logged in
  // Set the session variable
  $_SESSION['no_login_found'] = false;

  // Redirect the page to admin_login.php
  header("location:".HOME. 'admin/admin_login.php');
  exit(); // Stop further execution
}

?>
