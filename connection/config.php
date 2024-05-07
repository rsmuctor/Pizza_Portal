<?php

// Start the session
session_start();

// Create the config to store values that are non repeating
define('HOME', 'http://localhost/pizza_portal/');
define('LOCALHOST', 'localhost:3307');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pizza_portal_database');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); // Connect the database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); // Select the database

?>
