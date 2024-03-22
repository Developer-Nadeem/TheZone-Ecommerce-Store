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
    if (isset($productDetails)) {
      echo '<div class="row">
        <div class="col-6 img-magnifier-container">
          <img id="product-image" class="img-fluid product-img" src="' . $productDetails['ImageUrl'] . '" alt="' . $productDetails['ProductName'] . '">
        </div>
        <div class="col-6 product-desc">
          <h3>' . $productDetails['ProductName'] . '</h3>
          <p class="stars">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked">x</span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
          </p>
          <p class="price"><strong>£' . $productDetails['Price'] . '</strong></p>
          <p class="desc">' . $productDetails['ProductDescription'] . '</p>
          <br>
          <p>Size:</p>
          <div class="sizes">';
      /*             <Span><a href="#">XS</a></Span>
            <Span><a href="#">S </a></Span>
            <Span><a href="#">M </a></Span>
            <Span><a href="#">L </a></Span>
            <Span><a href="#">XL</a></Span> */
      echo '<form method="post">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown button
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
      $stmt = $db->prepare("SELECT s.* FROM sizes_table s JOIN stock_table st ON s.SizeID = st.SizeID WHERE st.ProductID = :productID");
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->bindValue(':productID', $productDetails['ProductID']);
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row) {
        echo '<a class="dropdown-item" href="#">' . $row['SizeName'] . '</a>'; //TODO: Fix this
      };
      echo '</div>';
      echo '</div>';

      echo '</div>
          <p >Quantity:</p>
            <input type="hidden" name="product-id" value="' . $productDetails['ProductID'] . '">
            <input class="Quantity" type="number" name="" id="" placeholder="1">
            <div class="product-btns">
              <button type="submit" name="add-to-cart" class="btn btn-outline-dark add-toCart">Add to Cart</button>
            </div>
          </form>
        </div>
      </div>';
    }
    ?>

  </div>

  <div class="container-fluid reviews">
    <h2>Reviews:</h2>
    <div class="row">
      <div class="col review">
        <p><Strong>Review 1:</Strong></p>
        <p>Spectacular Item</p>
      </div>
      <div class="col review">
        <p><Strong>Review 2:</Strong></p>
        <p>Spectacular Item</p>
      </div>
      <div class="col review">
        <p><Strong>Review 3:</Strong></p>
        <p>Spectacular Item</p>
      </div>
    </div>

  </div>

  <?php include('footer.php')  ?>
  <!-- Need for dropdown to work -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- End of dropdown to work -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
    function magnify(imgID, zoom) {
      var img, glass, w, h, bw;
      img = document.getElementById(imgID);

      /* This creates the magnifier glass */
      glass = document.createElement("DIV");
      glass.setAttribute("class", "img-magnifier-glass");

      /* This allows for the magnifier glass to show */
      img.parentElement.insertBefore(glass, img);

      glass.style.backgroundImage = "url('" + img.src + "')";
      glass.style.backgroundRepeat = "no-repeat";
      glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
      bw = 3;
      w = glass.offsetWidth / 2;
      h = glass.offsetHeight / 2;

      /* This is function when moving magnifier glass over image: */
      glass.addEventListener("mousemove", moveMagnifier);
      img.addEventListener("mousemove", moveMagnifier);

      /* This allows the magnifer to work for touch screens */
      glass.addEventListener("touchmove", moveMagnifier);
      img.addEventListener("touchmove", moveMagnifier);

      /* This is the function for moving the magnifier glass */
      function moveMagnifier(e) {
        var pos, x, y;

        /* This stops other things from happening when hovering*/
        e.preventDefault();

        /* This gets your mouse cursors x and y position: */
        pos = getCursorPos(e);
        x = pos.x;
        y = pos.y;

        /* This checks if the cursor is on the image or outside */
        if (x < 0 || x > img.width || y < 0 || y > img.height) {
          /* Hide the magnifier if the cursor is outside the image */
          glass.style.display = "none";
          return;
        } else {
          /* This will show the magnifier if the cursor is on the image */
          glass.style.display = "block";
        }

        /* This prevents the magnifier glass from being positioned outside the image: */
        if (x > img.width - (w / zoom)) {
          x = img.width - (w / zoom);
        }
        if (x < w / zoom) {
          x = w / zoom;
        }
        if (y > img.height - (h / zoom)) {
          y = img.height - (h / zoom);
        }
        if (y < h / zoom) {
          y = h / zoom;
        }

        /* Sets the position of the magnifier glass: */
        glass.style.left = (x - w) + "px";
        glass.style.top = (y - h) + "px";

        /* This displays what the magnifier glass sees */
        glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
      }

      function getCursorPos(e) {
        var a, x = 0,
          y = 0;
        e = e || window.event;
        /* Get x and y positions of image: */
        a = img.getBoundingClientRect();
        x = e.pageX - a.left;
        y = e.pageY - a.top;
        x = x - window.pageXOffset;
        y = y - window.pageYOffset;
        return {
          x: x,
          y: y
        };
      }
    }

    /* Execute magnify function: */
    magnify("product-image", 3); /* Strength of the magnifier glass */
  </script>
</body>

</html>