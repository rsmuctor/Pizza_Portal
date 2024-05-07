<?php

// Include config.php
include('../connection/config.php');

// Destory the session
session_destroy();

// Redirect page to admin_login.php
header('location:'.HOME.'admin/admin_login.php');
?>
