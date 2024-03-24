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


// Used to store and display the error/success messages
$errors = [];

if (isset($_SESSION['noInput1'])) {
  $errors[] = $_SESSION['noInput1'];
  unset($_SESSION['noInput1']);
}

if (isset($_SESSION['noInput2'])) {
  $errors[] = $_SESSION['noInput2'];
  unset($_SESSION['noInput2']);
}

if (isset($_SESSION['noMatch'])) {
  $errors[] = $_SESSION['noMatch'];
  unset($_SESSION['noMatch']);
}

if (isset($_SESSION['passLengthError'])) {
  $errors[] = $_SESSION['passLengthError'];
  unset($_SESSION['passLengthError']);
}

if (isset($_SESSION['passCaseError'])) {
  $errors[] = $_SESSION['passCaseError'];
  unset($_SESSION['passCaseError']);
}

if (isset($_SESSION['passNumError'])) {
  $errors[] = $_SESSION['passNumError'];
  unset($_SESSION['passNumError']);
}

if (isset($_SESSION['passSpecialCharError'])) {
  $errors[] = $_SESSION['passSpecialCharError'];
  unset($_SESSION['passSpecialCharError']);
}

if (isset($_SESSION['success'])) {
  $errors[] = $_SESSION['success'];
  unset($_SESSION['success']);
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
  <!--Navbar Start-->
  <?php include('navbar.php') ?>
  <!--Navbar End-->

  <main class="login-signup-page">
    <h2 style="font-weight: bold; margin: 10px; margin-bottom: auto;">Change Password</h2>
    <div class="form-wrapper" style="width: 30%; margin: 30px;">
      <div class="form-container">
        <div class="form-inner">
          <form action="change-password.php" method="POST" class="login">
            <div class="field">
              <input type="password" name="password" placeholder="Enter a new password">
            </div>
            <div class="field">
              <input type="password" name="confirm-password" placeholder="Confirm your new password">
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Change Password" name="change-pass">
              <input type="hidden" name="submitted" value="true" />
            </div>
            <div style="color: red;font-weight:bold;">
              <?php
              foreach ($errors as $error) {
                echo $error;
              }
              ?>
            </div>
            <div style="color:green; font-weight:bold;">
              <?php
              if (!empty($success)) {
                echo $success;
              }
              ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>


  <!-- Footer Start -->
  <?php include('footer.php') ?>
  <!-- Footer End -->

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>