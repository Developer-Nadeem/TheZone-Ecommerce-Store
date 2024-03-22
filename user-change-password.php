<?php
session_start();

// Checks if the user is logged in, if not it redirects you to the login/signup page
if (!isset($_SESSION['email'])) {
  header("Location: login-signup-page.php");
  exit();
}

if (!isset($_COOKIE['shopping_cart'])) {
  setcookie('shopping_cart', serialize(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
  setcookie('shopping_cart_json', json_encode(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
}

if (isset($_POST['add-to-cart'])) {
  $productId = $_POST['product-id'];

  $shopping_cart = isset($_COOKIE['shopping_cart']) ? unserialize($_COOKIE['shopping_cart']) : array();
  $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

  if (array_key_exists($productId, $shopping_cart)) {
    $shopping_cart[$productId] += $quantity;
  } else {
    $shopping_cart[$productId] = $quantity;
  };

  setcookie('shopping_cart', serialize($shopping_cart), time() + (86400), "/"); //Shopping cart cookie expires in a day
  setcookie('shopping_cart_json', json_encode($shopping_cart), time() + (86400), "/"); //Shopping cart cookie expires in a day
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change Password</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!--Navbar Start-->
  <?php include('navbar.php') ?>
  <!--Navbar End-->

  <form action="change-password.php" method="POST">
    <div class="field">
      <input type="text" name="email" placeholder="Enter your Email">
    </div>
    <div class="field">
      <input type="password" name="current-password" placeholder="Enter your current password">
    </div>
    <div class="field">
      <input type="password" name="new-password" placeholder="Enter a new password">
    </div>
    <div class="field">
      <input type="password" name="confirm-password" placeholder="Confirm your new password">
    </div>
    <div class="field btn">
      <div class="btn-layer"></div>
      <input type="submit" value="Change Password" name="change-pass">
      <input type="hidden" name="submitted" value="true" />
    </div>

  </form>



  <!-- Footer Start -->
  <?php include('footer.php') ?>
  <!-- Footer End -->

</body>

</html>