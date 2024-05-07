<?php include('includes/header.php'); ?>

<?php
// Check the food ID
if(isset($_GET['food_id'])) {
  // Get the food ID
  $food_id = $_GET['food_id'];

  // Display the food data
  $sql = "SELECT * FROM food_table WHERE id=$food_id";

  // Execute the query
  $res = mysqli_query($conn, $sql);

  // Count the rows
  $count = mysqli_num_rows($res);

  // Check if the food data is available
  if($count > 0) {
    // Food data is available
    $row=mysqli_fetch_assoc($res);
    // Get the values
    $category = $row['category'];
    $title = $row['title'];
    $price = $row['price'];
    $image_name = $row['image_name'];
  }
  else {
    // Food data is not available
    // Redirect the page to index.php
    header("location:".HOME. 'index.php');
    exit;
  }
}
else {
  // Redirect the page to index.php
  header("location:".HOME. 'index.php');
  exit;
}

?>

<div class="main_content">
  <div class="wrapper">

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>

    <h1>Order: <?php echo $title?></h1>

    <br/>
    <br/>

    <!-- Add the start again button --->
    <a href="index.php" class="button2">🔄 Start Again</a>

    <form action="" method="post" enctype="multipart/form-data">

      <table class="short_table">

        <br />

        <tr>
          <td>
            <?php
            if($image_name == "") {
              echo "<div class='failed'>❌ Display Food Image Failed!</div>";
            }
            else {
              ?>
              <img src="<?php echo HOME; ?>images/food_images/<?php echo $image_name; ?>" width="105px" height="105px" style="border: 2.5px solid black;">
              <?php
            }
            ?>
          </td>
        </tr>


        <tr>
          <td><input type="hidden" name="category" value="<?php echo $category; ?>" readonly></td>
        </tr>

        <tr>
          <td><input type="text" name="food" value="<?php echo $title; ?>" readonly></td>
        </tr>

        <tr>
          <td>  <input type="text" name="price" value="<?php echo $price; ?>" readonly></td>
        </tr>

        <tr>
          <td><input type="number" name="quantity" placeholder="Enter Quantity" value="" required></td>
        </tr>

        <tr>
          <td><input type="text" name="full_name" placeholder="Enter Full Name" value="" required></td>
        </tr>

        <tr>
          <td><input type="text" name="email" placeholder="Enter Email Address" value="" required></td>
        </tr>

        <tr>
          <td><input type="submit" name="submit" value="✔️ Confirm Order" class="button1"></td>
        </tr>

      </table>

    </form>

    <br />

  </div>
</div>


<?php include('includes/footer.php'); ?>

<?php
if(isset($_POST['submit'])) {
  $category = $_POST['category'];
  $food = $_POST['food'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];
  $total = $price * $quantity;
  $order_date = date("Y-m-d H:i:s");
  $status = "Pending";
  $customer_name = $_POST['full_name'];
  $customer_email = $_POST['email'];

  $sql2 = "INSERT INTO order_table SET category='$category', food='$food', price='$price', quantity='$quantity', total='$total', order_date='$order_date', status='$status', customer_name='$customer_name', customer_email='$customer_email'";

  $res2 = mysqli_query($conn, $sql2);

  if($res2) {
    $_SESSION['add'] = "<div class='successful'>✔️ Food Order Successful!</div>";
    header("location: index.php?food_id=$food_id");
    exit;
  } else {
    $_SESSION['add'] = "<div class='failed'>❌ Food Order Failed!</div>";
    header("location: index.php?food_id=$food_id");
    exit;
  }
}
?>
