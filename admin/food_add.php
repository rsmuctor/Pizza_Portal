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

    <h1>Add Food</h1>

    <br />

    <!-- Form starts here -->
    <form action="" method="post" enctype="multipart/form-data">

      <table class="short_table">

        <tr>
          <td>
            <input type="text" name="categoryDisplay" id="categoryDisplay" placeholder="Select Category" disabled>
          </td>
        </tr>

        <tr>
          <td>
            <button type="button" class="button2" onclick="setCategory('Pizzas')">Pizzas</button>
            <button type="button" class="button2" onclick="setCategory('Sides')">Sides</button>
            <button type="button" class="button2" onclick="setCategory('Desserts')">Desserts</button>
            <button type="button" class="button2" onclick="setCategory('Drinks')">Drinks</button>
            <input type="hidden" name="category" id="categoryInput" value="">
          </td>
        </tr>

        <tr>
          <td><input type="text" name="title" placeholder="Enter Title" maxlength="30" required></td>
        </tr>

        <tr>
          <td><input type="text" name="description" placeholder="Enter Description" maxlength="80" required></td>
        </tr>

        <tr>
          <td><input type="number" name="price" placeholder="Enter Price" required></td>
        </tr>

        <tr>
          <td><input class="input2" type="file" name="image"/></td>
        </tr>

        <tr>
          <td>
            <input type="text" name="Featured" placeholder="Select Featured" id="featuredDisplay" disabled required>
          </td>
        </tr>

        <tr>
          <td>
            <button type="button" class="button1" onclick="setFeatured('Yes')">Yes Featured</button>
            <button type="button" class="button3" onclick="setFeatured('No')">No Featured</button>
            <input type="hidden" name="featured" id="featuredInput" value="">
          </td>
        </tr>

        <tr>
          <td>
            <input type="submit" name="submit" value="✔️ Add Food" class="button1">
          </td>
        </tr>

      </table>

    </form>
    <!-- Form ends here -->

    <br />

    <?php
    if(isset($_SESSION['add'])) // Check the session is active
    {
      echo $_SESSION['add']; // Display the session message
      unset($_SESSION['add']); // Remove the session message
    }

    if(isset($_SESSION['upload'])) // Check the session is active
    {
      echo $_SESSION['upload']; // Display the session message
      unset($_SESSION['upload']); // Remove the session message
    }
    ?>

  </div>
</div>

<!-- Main content ends here -->

<?php include('../includes/admin_footer.php');?>

<?php
// Process the form value and save in the database
if(isset($_POST['submit'])) {
  // Get the form data
  $category = $_POST['category'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  // Check if the button is clicked or unclicked
  if(isset($_POST['featured'])) {
    // Get the form value
    $featured = $_POST['featured'];
  }
  else {
    // Set the default value
    $featured = "No";
  }

  // Check the image is selected or unselected
  if(isset($_FILES['image']['name'])) {
    // Upload the image
    $image_name = $_FILES['image']['name'];

    // Automatically rename the image
    // Get the image extension
    $ext = end(explode('.', $image_name));

    // Rename the image
    $image_name = "Food_Image_".rand(000,999).'.'."$ext";

    $source_path = $_FILES['image']['tmp_name'];

    $destination = "../images/food_images/".$image_name;

    // Upload the image
    $upload = move_uploaded_file($source_path, $destination);

    // Check the image upload
    if($upload==false) {
      // Set the message
      $_SESSION['upload'] = "<div class='failed text_center'>❌ Add Food Failed!<br /><br />⚠️ Image Upload Failed!<br /><br />🔁 Try Again!</div>";
      // Redirect page to food_add.php
      header("location:".HOME. 'admin/food_add.php');
      // Stop the process
      exit;
    }
  }
  else {
    // Don't upload the image
    $image_name = "";
  }

  // Save the data using SQL query
  $sql = "INSERT INTO food_table SET category='$category', title='$title', description='$description', price='$price', image_name='$image_name', featured='$featured'";

  // Execute the query and save the data
  $res = mysqli_query($conn, $sql);

  if($res==TRUE)
  {
    // Data is entered
    // Create the session to display message
    $_SESSION['add'] = "<div class='successful'>✔️ Add Food Successful!</div>";
    // Redirect the page to food manage.php
    header("location:".HOME. 'admin/food_manage.php');
    exit;
  }
  else {
    // Data is unentered
    // Create the session to display message
    $_SESSION['add'] = "<div class='failed'>❌ Add Food Failed!</div>";
    // Redirect page to food_add.php
    header("location:".HOME. 'admin/food_manage.php');
    exit;
  }
}

?>

<!-- JavaScript code -->
<script>
function setFeatured(value) {
  document.getElementById('featuredInput').value = value;
  document.getElementById('featuredDisplay').value = value;
}

function setAvailable(value) {
  document.getElementById('availableInput').value = value;
  document.getElementById('availableDisplay').value = value;
}

function setCategory(value) {
  document.getElementById('categoryInput').value = value;
  document.getElementById('categoryDisplay').value = value;
}
</script>
