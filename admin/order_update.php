<?php
include('../includes/admin_header.php');

// Check if the ID is set in the URL
if(isset($_GET['id'])) {
  $id = $_GET['id'];

  // Fetch the order details from the database
  $sql = "SELECT * FROM order_table WHERE id=$id";
  $res = mysqli_query($conn, $sql);

  // Check if the order exists
  if(mysqli_num_rows($res) == 1) {
    $row = mysqli_fetch_assoc($res);
    $food = $row['food'];
    $price = $row['price'];
    $quantity = $row['quantity'];
    $status = $row['status'];
    $customer_name = $row['customer_name'];
    $customer_email = $row['customer_email'];
  } else {
    // Redirect to order_manage.php if the order is not found
    header("location:".HOME. 'admin/order_manage.php');
    exit; // Stop further execution
  }
}

?>

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

    <h1>Update Order: <?php echo $food?></h1>

    <br />

    <form action="" method="post" enctype="multipart/form-data">

      <table class="short_table">

        <tr>
          <td><input type="text" name="food" placeholder="Enter Food" value="<?php echo $food; ?>" disabled></td>
        </tr>

        <tr>
          <td><input type="number" name="price" placeholder="Enter Price" value="<?php echo $price; ?>" required></td>
        </tr>

        <tr>
          <td><input type="number" name="quantity" placeholder="Enter Quantity" value="<?php echo $quantity; ?>" required></td>
        </tr>

        <tr>
          <td>
            <input type="text" name="statusDisplay" id="statusDisplay" placeholder="Select Status" value="<?php echo $status; ?>" disabled>
          </td>
        </tr>

        <tr>
          <td>
            <button type="button" class="button5" onclick="setStatus('Pending')">Pending</button>
            <button type="button" class="button6" onclick="setStatus('Preparing')">Preparing</button>
            <button type="button" class="button7" onclick="setStatus('Ready')">Ready</button>
            <button type="button" class="button8" onclick="setStatus('Cancelled')">Cancelled</button>
            <input type="hidden" name="status" id="statusInput" value="<?php echo $status; ?>">
          </td>
        </tr>

        <tr>
          <td><input type="text" name="full_name" placeholder="Enter Full Name" value="<?php echo $customer_name; ?>" required></td>
        </tr>

        <tr>
          <td><input type="text" name="email" placeholder="Enter Email Address" value="<?php echo $customer_email; ?>" required></td>
        </tr>

        <tr>
          <td>
            <input type="submit" name="submit" value="✔️ Update Order" class="button1">
          </td>
        </tr>

      </table>

    </form>

  </div>
</div>
<!-- Main content ends here -->

<?php
// Check if the form is submitted
if(isset($_POST['submit'])) {
  // Get the form data
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $status = $_POST['status'];
  $customer_name = $_POST['full_name'];
  $customer_email = $_POST['email'];

  // Calculate the total
  $total = $price * $quantity;

  // Update the order
  $sql2 = "UPDATE order_table SET price='$price', quantity='$quantity', total='$total', status='$status', customer_name='$customer_name', customer_email='$customer_email' WHERE id=$id";

  // Query the execute
  $res2 = mysqli_query($conn, $sql2);

  // Check the query is executed
  if($res2) {
    // Display the success message
    $_SESSION['update'] = "<div class='successful'>✔️ Update Order Successful!</div>";
    header("location:".HOME. 'admin/order_manage.php');
    exit;
  } else {
    // Display the fail message
    $_SESSION['update'] = "<div class='failed'>❌ Update Order Failed!</div>";
    header("location:".HOME. 'admin/order_manage.php');
    exit;
  }
}
?>

<?php include('../includes/admin_footer.php'); ?>

<!-- JavaScript code -->
<script>
function setStatus(value) {
  document.getElementById('statusInput').value = value;
  document.getElementById('statusDisplay').value = value;
}
</script>
