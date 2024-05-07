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

    <h1>Reset Password:</h1>

    <br />

    <?php
    if(isset($_GET['id'])) { // Check the session is active
      $id=$_GET['id'];
    }
    ?>

    <form action="" method="post">

      <table class="short_table">
        <tr>
          <td><input type="password" name="old_password" placeholder="Enter Old Password" required></td>
        </tr>

        <tr>
          <td><input type="password" name="new_password" placeholder="Enter New Password" required></td>
        </tr>

        <tr>
          <td><input type="password" name="confirm_password" placeholder="Confirm New Password" required></td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="submit" name="submit" value="✔️ Change Password" class="button1">
          </td>
        </tr>
      </table>

    </form>

  </div>
</div>

<?php
// Check if the button is clicked or unclicked

if(isset($_POST['submit'])) {
  // Get the form data
  $id=$_POST['id'];
  $old_password = md5($_POST['old_password']);
  $new_password = md5($_POST['new_password']);
  $confirm_password = md5($_POST['confirm_password']);

  // Check if the current data exists
  $sql = "SELECT * FROM admin_table WHERE id=$id AND password='$old_password'";

  // Query to execute
  $res = mysqli_query($conn, $sql);

  if($res==true) {
    // Check if the data is available
    $count=mysqli_num_rows($res);
    if($count==1) {

      // Check if the new password confirms
      if($new_password==$confirm_password) {

        // Update the password
        $sql2 = "UPDATE admin_table SET password='$new_password' WHERE id=$id";

        // Query the execute
        $res2 = mysqli_query($conn, $sql2);

        // Check if the query executes
        if($res2==true) {

          // Display the success message
          $_SESSION['reset_password'] = "<div class='successful'>✔️ Reset Password Successful!</div>";

          // Redirect page to admin_manage.php
          header("location:".HOME. 'admin/admin_manage.php');
          exit();
        }
        else {

          // Display the error message
          $_SESSION['wrong_password'] = "<div class='failed'>❌ Reset Password Failed!</div>";

          // Redirect the page to admin_manage.php
          header("location:".HOME. 'admin/admin_manage.php');
          exit();
        }
      }
      else {
        // The passwords do not match
        $_SESSION['wrong_password'] = "<div class='failed'>❌ Reset Password Failed!<br /><br />⚠️ Password Does Not Match!<br /><br />🔁 Try Again!</div>";

        // Redirect page to admin_manage.php with the error message
        header("location:".HOME. 'admin/admin_manage.php');
        exit();
      }
    }
    else {
      // The password does not exist
      $_SESSION['no_password_found'] = "<div class='failed'>🔴 Reset Password Failed!<br /><br />⚠️ No Password Found!<br /><br />🔁 Try Again!</div>";

      // Redirect page to admin_manage.php
      header("location:".HOME. 'admin/admin_manage.php');
      exit();
    }
  }
}
?>

<!-- Main content ends here -->

<?php include('../includes/admin_footer.php');?>
