<?php include('../connection/config.php');?>

<?php include('login_status.php');?>

<html>
<div class="overlay" id="overlay"></div>
<head>
  <title>Pizza Portal: Admin Panel</title>
  <link rel="stylesheet" href="../css/admin_style.css"/>
</head>

<body>
  <!-- Header starts here -->
  <div class="header text_center">
    <div class="wrapper">
      <div class="logo">
        <a href="admin_home.php">
          <img src="../images/logo.png" alt="Pizza Portal Logo">
        </div>

      </br>

      <ul>
        <li><a href="admin_home.php">Home</a></li>
        <li><a href="admin_manage.php">Admin</a></li>
        <li><a href="food_manage.php">Food</a></li>
        <li><a href="order_manage.php">Order</a></li>
        <li><a href="admin_logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
  <!-- Header ends here -->
