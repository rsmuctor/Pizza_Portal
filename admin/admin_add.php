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

    <h1>Add Admin</h1>

    <br />

    <?php
    if(isset($_SESSION['add'])) // Check the session is active
    {
      echo $_SESSION['add']; // Display the session message
      unset($_SESSION['add']); // Remove the session message
    }
    ?>

    <!-- Form starts here -->
    <form action="" method="post">

      <table class="short_table">
        <tr>
          <td><input type="text" name="full_name" placeholder="Enter Full Name" required></td>
        </tr>

        <tr>
          <td><input type="text" name="username" placeholder="Enter Username" required></td>
        </tr>

        <tr>
          <td><input type="password" name="password" placeholder="Enter Password" required></td>
        </tr>

        <tr>
          <td>
            <input type="submit" name="submit" value="✔️ Add Admin" class="button1">
          </td>
        </tr>

      </table>

    </form>
    <!-- Form ends here -->

  </div>
</div>
<!-- Main content ends here -->

<?php include('../includes/admin_footer.php');?>

<?php
// Process form value and save in the database
// Check if the button is clicked or unclicked

if(isset($_POST['submit'])) {
  // Get the form data
  $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
  $username = isset($_POST['username']) ? $_POST['username'] : '';
  $password = isset($_POST['password']) ? md5($_POST['password']) : ''; // Password encryption using MD5

  // Save data using the SQL query
  $sql = "INSERT INTO admin_table (full_name, username, password)
  VALUES ('$full_name', '$username', '$password')";

  // Execute the query and save the data
  $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  if($res==TRUE)
  {
    // Data is entered
    // Create session to display the message
    $_SESSION['add'] = "<div class='successful'>✔️ Add Admin Successful!</div>";
    // Redirect page to admin_manage.php
    header("location:".HOME. 'admin/admin_manage.php');
  }
  else {
    // Data is unentered
    // Create session to display the message
    $_SESSION['add'] = "<div class='failed'>❌ Add Admin Failed!</div>";
    // Redirect page to admin_add.php
    header("location:".HOME. 'admin/admin_add.php');
  }
}

?>
