<?php
session_start();
require("connectiondb.php");

if (isset($_GET['product_id'])) {
  $product = $_GET['product_id'];
  $_SESSION['product_id'] = $_GET['product_id'];

  $stmt = $db->prepare("SELECT ProductID, ProductName, ProductDescription ,Price, ImageUrl FROM inventory WHERE ProductID = ?");
  $stmt->execute([$product]);
  $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);
}

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
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php echo $productDetails['ProductName']; ?>
  </title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css"
    integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
</head>

<body>
  <?php include('navbar.php') ?>

  <div class="container-fluid">
    <?php

    if (isset($productDetails)) {
      echo
        '<div class="row">
        <div class="col-6"><img class="img-fluid product-img" src="' . $productDetails['ImageUrl'] . '" alt="' . $productDetails['ProductName'] . '"></div>
        <div class="col-6 product-desc">
          <h3>' . $productDetails['ProductName'] . '</h3>
            <p class="stars">
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
            </p>
        <p class="price"><strong>£' . $productDetails['Price'] . '</strong></p>
        <p class="desc">' . $productDetails['ProductDescription'] . '</p>
        <br>
        <p>Size:</p>
        <div class="sizes">
        <Span><a href="#">XS</a></Span>
        <Span><a href="#">S </a></Span>
        <Span><a href="#">M </a></Span>
        <Span><a href="#">L </a></Span>
        <Span><a href="#">XL</a></Span>
        </div>
        <p >Quantity:</p>
        <form method="post">
          <input type="hidden" name="product-id" value="' . $productDetails['ProductID'] . '">
          <input class="Quantity" type="number" name="" id="" placeholder="1">
          <div class="product-btns">
          <button type="submit" name="add-to-cart" class="btn btn-outline-dark add-toCart">Add to Cart</button>
          <button type="button" class="btn btn-outline-dark Buy-Now">Buy Now</button>
          </div>
        </form>
      </div>
    </div>
  </div>';
    } ?>

    <div class="container-fluid reviews">
      <h2>Reviews:</h2>

      <form method="post" action="../TheZone/product-page.php">
        <div class="form-group">
          <label class="feedback-box" for="exampleFormControlTextarea1">Feedback:</label>
          <textarea style="resize: none;" class="form-control feedback-box" name="feedback-box"
            id="exampleFormControlTextarea1" rows="3"></textarea>
          <div class="container"">
            <div class="row">
              <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3">
              </div>

              <span class='result'>0</span>
              <input type="hidden" name="rating">
            </div>
            <input class="contact-input-submit" type="submit" value="Submit">
            <input type="hidden" name="submitted" value="true">
      </form>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

  <script>


    $(function () {
      $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
        var rating = data.rating;
        $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
        $(this).parent().find('.result').text('rating :' + rating);
        $(this).parent().find('input[name=rating]').val(rating);
      });
    });

  </script>

  </div>


  <div class="row">
    <div class="col review">
      <p><Strong>Review 1:</Strong></p>
      <p>Specatcular Item</p>
    </div>
    <div class="col review">
      <p><Strong>Review 2:</Strong></p>
      <p>Specatcular Item</p>
    </div>
    <div class="col review">
      <p><Strong>Review 3:</Strong></p>
      <p>Specatcular Item</p>
    </div>
  </div>

  </div>

  <?php

  include("../TheZone/connectiondb.php");

  if (isset($_POST['submitted']) && !empty(trim($_POST['feedback-box']) && isset($_POST['rating']))) {

    try {
      $addReview = $db->prepare("INSERT INTO reviews (ProductID, Rating, Description) VALUES (:ProductID, :Rating, :Descript)");
      $addReview->bindParam(':ProductID', $_GET['product_id']);
      $addReview->bindParam(':Rating', $_POST['rating']);
      $addReview->bindParam(':Descript', $_POST['feedback-box']);
      $userID = $db->query("SELECT UserID FROM useraccounts WHERE email = '{$_SESSION['email']}'")->fetch();
      // $addReview->bindParam(':UserID', $userID);
      $addReview->execute();

    } catch (PDOException $ex) {
      print("Sorry a database error occurred.". $ex->getMessage());

    }

  }
  ?>













  <?php include('footer.php') ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>