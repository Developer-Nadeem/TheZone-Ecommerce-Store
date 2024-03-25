<?php
session_start();
require("connectiondb.php");

if (isset($_GET['product_id'])) {
  $product = $_GET['product_id'];

  $stmt = $db->prepare("SELECT ProductID, ProductName, ProductDescription, Price, ImageUrl FROM inventory WHERE ProductID = ?");
  $stmt->execute([$product]);
  $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!isset($_COOKIE['shopping_cart'])) {
  setcookie('shopping_cart', serialize(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
  setcookie('shopping_cart_json', json_encode(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
}

if (isset($_POST['add-to-cart'])) {
  $productId = $_POST['product-id'];

  $size = $_POST['selected-size'];

  if (!isset($size) || empty($size)) {
    echo '<script>alert("Please select a size")</script>';
  } else {
    $shopping_cart = isset($_COOKIE['shopping_cart']) ? unserialize($_COOKIE['shopping_cart']) : array();
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

    $productKey = $productId . '|' . $size;

    if (array_key_exists($productKey, $shopping_cart)) {
      $shopping_cart[$productKey]['quantity'] += $quantity;
    } else {
      $shopping_cart[$productKey] = array('quantity' => $quantity, 'size' => $size);
    }

    setcookie('shopping_cart', serialize($shopping_cart), time() + (86400), "/"); //Shopping cart cookie expires in a day
    setcookie('shopping_cart_json', json_encode($shopping_cart), time() + (86400), "/"); //Shopping cart cookie expires in a day
  }
}

// gets the rating of the product
$stmt = $db->prepare("SELECT AVG(Rating) as avg_rating FROM reviews WHERE ProductID = :productID");
$stmt->bindParam(':productID', $product);
$stmt->execute();
$rating = $stmt->fetchColumn();

$reviewErrors = [];

if (isset($_SESSION['noRating'])) {
  $reviewErrors[] = $_SESSION['noRating'];
  unset($_SESSION['noRating']);
}

if (isset($_SESSION['noDesc'])) {
  $reviewErrors[] = $_SESSION['noDesc'];
  unset($_SESSION['noDesc']);
}

if (isset($_SESSION['reviewSubmit'])) {
  $reviewSuccess = $_SESSION['reviewSubmit'];
  unset($_SESSION['reviewSubmit']);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $productDetails['ProductName']; ?></title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    .img-magnifier-container {
      position: relative;
    }

    .img-magnifier-glass {
      position: absolute;
      border: 3px solid #000;
      border-radius: 50%;
      cursor: none;
      /* Sets the size of the magnifier glass: */
      width: 150px;
      height: 150px;
      display: none;
    }
  </style>
</head>

<body>
  <?php include('navbar.php') ?>

  <div class="container-fluid">
    <?php
    if (isset($productDetails)) { ?>
      <div class="row">
        <div class="col-6 img-magnifier-container">
          <img id="product-image" class="img-fluid product-img" src="<?php echo $productDetails['ImageUrl'] ?>" alt="' <?php echo $productDetails['ProductName'] ?> '">
        </div>
        <div class="col-6 product-desc">
          <h3><?php echo $productDetails['ProductName'] ?></h3>
          <?php
          if ($rating === false) {
            $rating = 0;
          }
          if ($rating !== false) {
            echo '<p class="stars" style= padding-top:10px>';
            for ($i = 1; $i <= 5; $i++) {
              if ($i <= round($rating)) {
                echo '<span class="fa fa-star fa-2x checked"></span>';
              } else {
                echo '<span class="fa fa-star fa-2x"></span>';
              }
            }
          }
          ?>
          </p>
          <p class="price" style="font-size: large;"><strong>£<?php echo $productDetails['Price'] ?></strong></p>
          <p class="desc"><?php echo $productDetails['ProductDescription'] ?></p>
          <br>
          <p>Size:</p>
          <div class="sizes">
            <form method="post">
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Choose Size
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <?php
                  $stmt = $db->prepare("SELECT s.SizeName, st.Quantity FROM sizes_table s JOIN stock_table st ON s.SizeID = st.SizeID WHERE st.ProductID = :productID");
                  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  $stmt->bindValue(':productID', $productDetails['ProductID']);
                  $stmt->execute();
                  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($rows as $row) {
                    $outOfStock = ($row['Quantity'] <= 0) ? 'disabled' : '';
                    $noStockTxt = ($row['Quantity'] <= 0) ? '(Out of Stock)' : '';
                    echo '<a class="dropdown-item ' . $outOfStock . '" name="sizeDropdownOption">' . $row['SizeName'] . $noStockTxt . '</a>';
                  } ?>
                </div>
              </div>

          </div>
          <input type="hidden" name="selected-size" id="selectedSize" value="">
          <p>Quantity:</p>
          <input type="hidden" name="product-id" value="<?php echo $productDetails['ProductID'] ?>">
          <input class="Quantity" type="number" min=1 name="" id="" placeholder="1">
          <div class="product-btns">
            <button type="submit" name="add-to-cart" class="btn btn-outline-dark add-toCart">Add to Cart</button>
          </div>
          </form>
        </div>
      </div>
    <?php }
    ?>

  </div>


  <?php
  if (isset($_SESSION['email'])) { ?>
    <div class="reviews">
      <div class="reviews-heading">
        <h2>Write a Review</h2>
      </div>

      <div class="reviews-container">
        <div class="create-review">
          <form method="post" action="review.php" class="review-form" name="create-review">
            <div class="stars-rating">
              <Strong>Rating:</strong>
              <span class="fa fa-star fa-2x"></span>
              <span class="fa fa-star fa-2x"></span>
              <span class="fa fa-star fa-2x"></span>
              <span class="fa fa-star fa-2x"></span>
              <span class="fa fa-star fa-2x"></span>
            </div>
            <div>
              <textarea rows="4" col="50" placeholder="Review description" class="textarea-description" name="description"></textarea>
            </div>
            <div class="review-button">
              <input type="submit" value="Submit Review" name="submit">
              <input type="hidden" name="submitted" value="true">
              <input type="hidden" name="product-id" value="<?php echo $productDetails['ProductID'] ?>">
            </div>
            <div style="color: red;">
              <?php foreach ($reviewErrors as $errors) {
                echo $errors;
              } ?>
            </div>
            <div style="color: green;">
              <?php if (!empty($reviewSuccess)) {
                echo $reviewSuccess;
              } ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>

  <div class="reviews">
    <div class="reviews-heading">
      <h2>Customer Reviews</h2>
    </div>
    <?php
    $stmt = $db->prepare("SELECT r.UserID, r.Rating, r.Description, u.Firstname, u.Lastname FROM reviews r INNER JOIN useraccounts u ON r.UserID = u.UserID WHERE r.ProductID = ?");
    $stmt->execute([$product]);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($reviews) > 0) {
      foreach ($reviews as $review) {
        $fname = $review['Firstname'];
        $lname = $review['Lastname'];
        $rating = $review['Rating'];
        $description = $review['Description'];
    ?>
        <div class="reviews-container">
          <div class="review">
            <div class="review-top">
              <div class="customer-name">
                <strong>Author: <?php echo $fname . ' ' . $lname ?></strong>
                <div class="customer-rating">
                  <?php
                  if ($rating === false) {
                    $rating = 0;
                  }
                  if ($rating !== false) {
                    for ($i = 1; $i <= 5; $i++) {
                      if ($i <= $rating) {
                        echo '<span class="fa fa-star checked"></span>';
                      } else {
                        echo '<span class="fa fa-star"></span>';
                      }
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="customer-description">
              <p><?php echo $description ?> </p>
            </div>
          </div>
        </div>
    <?php }
    } else {
      echo '<p> Looks like there are no reviews for this product';
    } ?>
  </div>
  </div>



  <?php include('footer.php')  ?>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.getElementsByName('sizeDropdownOption').forEach((option) => {
        option.addEventListener('click', (e) => {
          document.getElementById('selectedSize').value = e.target.innerText;
        });
      });
    })
  </script>

  <!-- Script for stars rating -->
  <script>
    var starsRating = document.querySelectorAll(".stars-rating span");
    var starInput = document.createElement("input");
    starInput.type = "hidden";
    starInput.name = "rating";
    document.querySelector('form[name ="create-review"]').appendChild(starInput);


    starsRating.forEach((star, index) => {
      star.addEventListener("click", () => {
        starsRating.forEach((star, index2) => {
          index >= index2 ? star.classList.add("checked") : star.classList.remove("checked");
        });
        starInput.value = index + 1;
      });
    });
  </script>



  <!-- Need for dropdown to work -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- End of dropdown to work -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="magnify.js"> </script>
</body>

</html>