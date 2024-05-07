<?php include('../includes/admin_header.php');?>

<?php
if(isset($_GET['id'])) {
  $id=$_GET['id'];
  $sql2 = "SELECT * FROM food_table WHERE id=$id";
  $res2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($res2);

  // Get the values of the food selected
  $category = $row2['category'];
  $title = $row2['title'];
  $description = $row2['description'];
  $price = $row2['price'];
  $current_image = $row2['image_name'];
  $featured = $row2['featured'];

} else {
  // Redirect page to food_manage.php
  header("location:".HOME. 'admin/food_manage.php');
}

// Process the form value and save in the database
if(isset($_POST['submit'])) {
  // Get the form data
  $id = $_POST['id'];
  $newCategory = $_POST['category']; // Get the selected category from the form
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $featured = $_POST['featured']; // Get the selected featured value

  // Check if the category has changed and is not empty
  if (!empty($newCategory) && $newCategory != $category) {
    $category = $newCategory; // Update the category only if it has changed
  }

  // Check if a new image is uploaded
  if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="") {
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Rename the image
    $image_name = "Food_Image_".uniqid().'.jpg'; // The file will always save as JPG

    // Upload the image
    $upload_path = "../images/food_images/".$image_name;
    if(move_uploaded_file($image_tmp, $upload_path)) {
      // Remove the old image if exists
      if(!empty($current_image)) {
        $old_image_path = "../images/food_images/".$current_image;
        unlink($old_image_path);
      }
    } else {
      // Upload the failed
      $_SESSION['upload'] = "<div class='failed text_center'>❌ Update Food Failed!<br /><br />⚠️ Image Upload Failed!<br /><br />🔁 Try Again!</div>";
      header("location:".HOME. 'admin/food_update.php');
      exit;
    }
  } else {
    // No new image has been uploaded
    $image_name = $current_image;
  }

  // Update the data using the SQL query
  $sql3 = "UPDATE food_table SET category='$category', title='$title', description='$description', price='$price', image_name='$image_name', featured='$featured' WHERE id=$id";

  // Execute the query and update the data
  $res3 = mysqli_query($conn, $sql3);

  if($res3==TRUE) {
    // Data is updated
    $_SESSION['add'] = "<div class='successful'>✔️ Update Food Successful!</div>";
    header("location:".HOME. 'admin/food_manage.php');
    exit;
  } else {
    // Data is not updated
    $_SESSION['add'] = "<div class='failed'>❌ Update Food Failed!</div>";
    header("location:".HOME. 'admin/food_manage.php');
    exit;
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

    <h1>Update Food: <?php echo $title?></h1>

    <br />

    <form action="" method="post" enctype="multipart/form-data">

      <table class="short_table">

        <tr>
          <td>
            <input type="text" name="categoryDisplay" id="categoryDisplay" placeholder="Select Category" value="<?php echo $category; ?>" disabled>
          </td>
        </tr>

        <tr>
          <td>
            <button type="button" class="button2" onclick="setCategory('Pizzas')">Pizzas</button>
            <button type="button" class="button2" onclick="setCategory('Sides')">Sides</button>
            <button type="button" class="button2" onclick="setCategory('Desserts')">Desserts</button>
            <button type="button" class="button2" onclick="setCategory('Drinks')">Drinks</button>
            <input type="hidden" name="category" id="categoryInput" value="<?php echo $category; ?>">
          </td>
        </tr>

        <tr>
          <td><input type="text" name="title" placeholder="Enter Title" value="<?php echo $title; ?>" maxlength="30" required></td>
        </tr>

        <tr>
          <td><input type="text" name="description" id="description" placeholder="Enter Description" value="<?php echo $description; ?>" maxlength="80" required></td>
        </tr>

        <tr>
          <td><input type="number" name="price" placeholder="Enter Price" value="<?php echo $price; ?>" required></td>
        </tr>

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <tr>
          <td>
            <?php
            if($current_image == "") {
              // Image is unavailable
              echo "<div class='failed'>❌ Display Food Image Failed!</div>";
            }
            else {
              // Image is available
              ?>
              <div><h4>Current Image:<br /></h4></div>
              <img src="<?php echo HOME; ?>images/food_images/<?php echo $current_image; ?>" width="105px" height="105px" style="border: 2.5px solid black;">
              <?php
            }
            ?>
          </td>
        </tr>

        <tr>
          <td><input class="input2" type="file" name="image"/></td>
        </tr>

        <tr>
          <td>
            <input type="text" name="Featured" placeholder="Select Featured" id="featuredDisplay" value="<?php echo $featured; ?>" disabled required>
          </td>
        </tr>

        <tr>
          <td>
            <button type="button" class="button1" onclick="setFeatured('Yes')">Yes Featured</button>
            <button type="button" class="button3" onclick="setFeatured('No')">No Featured</button>
            <input type="hidden" name="featured" id="featuredInput" value="<?php echo $featured; ?>">
          </td>
        </tr>

        <tr>
          <td>
            <input type="submit" name="submit" value="✔️ Update Food" class="button1">
          </td>
        </tr>

      </table>

    </form>

  </div>
</div>
<!-- Main content ends here -->

<?php include('../includes/admin_footer.php');?>

<!-- JavaScript code -->
<script>
function setFeatured(value) {
  document.getElementById('featuredInput').value = value;
  document.getElementById('featuredDisplay').value = value;
}

function setCategory(value) {
  document.getElementById('categoryInput').value = value;
  document.getElementById('categoryDisplay').value = value;
}
</script>
