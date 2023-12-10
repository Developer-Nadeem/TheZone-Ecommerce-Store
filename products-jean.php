<?php
session_start();

if (!isset($_COOKIE['shopping_cart'])) {
  setcookie('shopping_cart', serialize(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
  setcookie('shopping_cart_json', json_encode(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
}

if (isset($_POST['add-to-cart'])) {
  $productId = $_POST['product-id'];

  $shoppingCart = isset($_COOKIE['shopping_cart']) ? unserialize($_COOKIE['shopping_cart']) : array();

  array_push($shoppingCart, $productId);

  setcookie('shopping_cart', serialize($shoppingCart), time() + (86400), "/"); //Shopping cart cookie expires in a day

  setcookie('shopping_cart_json', json_encode($shoppingCart), time() + (86400), "/"); //Shopping cart cookie expires in a day
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Same head for a consistent format -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jeans</title>
  <link rel="stylesheet" href="..\TheZone\style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!--Navbar Start-->
  <?php include('..\TheZone\\navbar.php') ?>
  <!--Navbar End-->

  <main>
    <h1 class="text-center">Jeans</h1>
    <p class="text-center">Explore The Zone's exclusive jeans collection, where streetwear fashion meets comfort, offering the latest styles to elevate your urban lifestyle.</p>
    <div class="container mt-6">
      <div class="row">
        <?php
        // gets the db
        require("connectiondb.php");

        // gets all products under the Jean category
        $stmt = $db->query("SELECT ProductID, ProductName, Price, ImageUrl FROM inventory WHERE CategoryID = 5");

        // loops through all the db's rows and display the products for mens
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">';
          echo '<div class="card" style="width: 18rem">';
          echo '<img src="' . $row['ImageUrl'] . '" class="card-img-top" alt="' . $row['ProductName'] . '">';
          echo '<div class="card-body">';
          echo '<p class="card-text">' . $row['ProductName'] . '</p>';
          echo '<p class="card-text"><strong>£' . $row['Price'] . '</strong></p>';
          echo '<form method="post">';
          echo '<input type="hidden" name="product-id" value="' . $row['ProductID'] . '">';
          echo '<button type="submit" name="add-to-cart" class="btn btn-dark add-to-cart">Add To Cart</button>';
          echo '</form>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
  </script>

  <!-- Footer Start -->
  <?php include('..\TheZone\footer.php') ?>
  <!-- Footer End -->
</body>

</html>