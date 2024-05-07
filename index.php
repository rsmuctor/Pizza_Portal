<?php include('includes/header.php');?>

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

    <h1 class="text_center">Get Started: Order Here</h1>

    <?php
    if(isset($_SESSION['add']))
    echo $_SESSION['add'];
    unset($_SESSION['add']);
    ?>

    <br/>

    <div class="column_4 text_center">
      <h2>Pizzas</h2>
      <br />

      <img src="images/food_pizzas.jpg" width="250px" height="250px" style="border: 2.5px solid black;">

      <br />
      <br />

      <a href='food_pizzas.php' class="button1">🍕 Explore Pizzas</a>

    </div>

    <div class="column_4 text_center">
      <h2>Sides</h2>
      <br />

      <img src="images/food_sides.jpg" width="250px" height="250px" style="border: 2.5px solid black;">

      <br />
      <br />

      <a href="food_sides.php" class="button1">🍟 Explore Sides</a>

    </div>

    <div class="column_4 text_center">
      <h2>Desserts</h2>
      <br />

      <img src="images/food_desserts.jpg" width="250px" height="250px" style="border: 2.5px solid black;">

      <br />
      <br />

      <a href="food_desserts.php" class="button1">🍰 Explore Desserts</a>

    </div>

    <div class="column_4 text_center">
      <h2>Drinks</h2>
      <br />

      <img src="images/food_drinks.jpg" width="250px" height="250px" style="border: 2.5px solid black;">

      <br />
      <br />

      <a href="food_drinks.php" class="button1">🍹 Explore Drinks</a>

    </div>

    <div class="fix"></div>

  </div>
</div>
<!-- Main content ends here -->

<?php include('includes/footer.php');?>
