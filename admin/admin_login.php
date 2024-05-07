<?php include('../includes/login_header.php');?>

<?php include('../connection/config.php');?>

<!-- Main content starts here -->
<html>
<link rel="stylesheet" href="../css/admin_style.css">

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

    <h1>Admin Login</h1>

    <br />

    <form action="" method="post">

      <table class="short_table">
        <tr>
          <td><input type="text" name="username" placeholder="Enter Username" required></td>
        </tr>

        <tr>
          <td><input type="password" name="password" placeholder="Enter Password" required></td>
        </tr>

        <tr>
          <td>
            <input type="submit" name="submit" value="✔️ Login" class="button1">
          </td>
        </tr>
      </table>

    </form>

    <br />

    <?php
    if(isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }
    if(isset($_SESSION['no_login_found'])) {
      echo $_SESSION['no_login_found'];
      unset($_SESSION['no_login_found']);
    }
    ?>

  </div>
</div>
<!-- Main content ends here -->

</html>

<?php include('../includes/admin_footer.php');?>

<?php
// Process the form value and check if stored in the database
// Check if the button is clicked or unclicked

if(isset($_POST['submit'])) {
  // Get the form data
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  // SQL query to check the data exists
  $sql = "SELECT * FROM admin_table WHERE username='$username' AND password='$password'";

  // Execute the SQL query
  $res = mysqli_query($conn, $sql);

  // Check if the user exists
  $count = mysqli_num_rows($res);

  if($count==1) {
    // If the user is available, the login is successful
    $_SESSION['login'] = "<div class='success'>✔️ Admin Login Successful!</div>";
    $_SESSION['user'] = $username; // Check if the user is logged in, logout will destory the session
    // Redirect page to admin_home.php
    header("location:".HOME. 'admin/admin_home.php');
  }
  else {
    // If the user is unavailable, the login is unsuccessful
    $_SESSION['login'] = "<div class='failed text_center'>❌ Admin Login Failed!<br /><br />⚠️ Username/Password Does Not Match!<br /><br />🔁 Try Again!</div>";
    // Redirect page to admin_home.php
    header("location:".HOME. 'admin/admin_login.php');
  }
}
?>
