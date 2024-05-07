<?php include('includes/header.php'); ?>

<!-- Main content starts here -->
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

    <h1 class="text_center">Pizzas</h1>

    <br/>
    <br/>

    <!-- Add the start again button --->
    <a href="index.php" class="button2">🔄 Start Again</a>

    <br/>
    <br/>
    <br/>

    <?php
    // Display the pizzas
    $sql = "SELECT * FROM food_table WHERE category='pizzas' AND featured='Yes'";
    // Execute the query
    $res = mysqli_query($conn, $sql);
    // Count the rows
    $count = mysqli_num_rows($res);

    // Check the pizzas are available
    if($count > 0) {
      // Pizzas are available
      while($row=mysqli_fetch_assoc($res)) {
        // Get the value
        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image_name = $row['image_name'];
        ?>

        <div class="column_4 text_center">
          <h2><?php echo $title; ?></h2>
          <br />
          <?php
          // Check the image is availabile
          if($image_name!="") {
            // Display the image
            ?>
            <div class="food_image_container">
              <img src="<?php echo HOME; ?>images/food_images/<?php echo $image_name; ?>" width="250px" height="250px" style="border: 2.5px solid black;">
            </div>
            <?php
          } else {
            // Image is not available
            echo "<div class='failed text_center'>❌ Display Food Image Failed!</div>";
          }
          ?>
          <br />
          <h3>£<?php echo $price; ?></h3>
          <br />
          <h4><?php echo $description; ?></h4>
          <br />
          <a href="<?php echo HOME; ?>food_order.php?food_id=<?php echo $id;?>" class="button1">🛒 Order Food</a>
        </div>

        <?php
      }
    }
    else {
      // Pizzas is not available
      echo "<div class='failed text_center'>❌ Display Pizzas Failed!<br /><br />⚠️ No Pizzas Added!</div>";
    }
    ?>

    <div class="fix"></div>

    <br/>
    <br/>

  </div>
</div>
<!-- Main content ends here -->

<?php include('includes/footer.php'); ?>
