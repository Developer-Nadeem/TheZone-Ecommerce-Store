<?php
session_start();

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
  <!-- Same head for a consistent format -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jeans</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!--Navbar Start-->
  <?php include('navbar.php') ?>
  <!--Navbar End-->
  <!-- Filter Box Start -->
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-6 offset-md-3">

        <form method="get" class="d-flex align-items-center justify-content-end" id="filterForm">
          <label class="me-2">Sort by:</label>
          <select name="sort" class="form-select">
            <option value="default">None</option>
            <option value="low-high">Price: Low to High</option>
            <option value="high-low">Price: High to Low</option>
          </select>

          <!-- Brand Filter -->
          <label class="ms-2">Brand:</label>
          <select name="brand" class="form-select ms-2">
            <option value="all">All Brands</option>
            <option value="champion x coca cola">champion x coca cola</option>
            <option value="prosto yezz">prosto yezz</option>
            <option value="converse">converse</option>
            <option value="vans">vans</option>
            <option value="prosto">prosto</option>
            <option value="carhatt">carhartt</option>
            <option value="MassDnm">MassDnm</option>
            <option value="Etnies">Etnies</option>
            <option value="Es">Es</option>
            <option value="Thrasher">Thrasher</option>
            <option value="Method">Method</option>
            <option value="Burton">Burton</option>
          </select>

          <!-- Price Range Filter -->
          <label class="ms-2">Price Range:</label>
          <input type="text" name="minPrice" placeholder="Min Price" class="form-control ms-2" style="width: 100px;">
          <input type="text" name="maxPrice" placeholder="Max Price" class="form-control ms-2" style="width: 100px;">

          <button type="submit" onclick="applyFilters()" class="btn btn-secondary ms-2">
            <i class="Apply sort"></i> Apply Filters
          </button>
        </form>
      </div>
    </div>
  </div>

  <main>
    <h1 class="text-center">Jeans</h1>
    <p class="text-center">Explore The Zone's exclusive Jean collection, where streetwear fashion meets comfort, offering the latest styles to elevate your urban lifestyle.</p>
    <div class="container mt-6">
      <div class="row">
        <?php
        // gets the db
        require("connectiondb.php");


        // This is for the sort by feature
        $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'default';
        $orderBy = '';

        switch ($sortOption) {
          case 'low-high':
            $orderBy = 'ORDER BY Price ASC';
            break;
          case 'high-low':
            $orderBy = 'ORDER BY Price DESC';
            break;
          default:
            break;
        }

        //This is the code that sorts the products by brand
        $brandFilter = isset($_GET['brand']) ? $_GET['brand'] : 'all';
        $brandCondition = ($brandFilter != 'all') ? " AND ProductName LIKE '%$brandFilter%'" : '';

        //This is the code that filters products by price range
        $minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : null;
        $maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : null;
        $priceCondition = '';

        if ($minPrice !== null && $maxPrice !== null && $minPrice !== '' && $maxPrice !== '') {
          $priceCondition = " AND Price BETWEEN $minPrice AND $maxPrice";
        } elseif ($minPrice !== null && $minPrice !== '') {
          $priceCondition = " AND Price >= $minPrice";
        } elseif ($maxPrice !== null && $maxPrice !== '') {
          $priceCondition = " AND Price <= $maxPrice";
        }

        // gets all male products
        $stmt = $db->query("SELECT ProductID, ProductName, Price, ImageUrl FROM inventory WHERE CategoryID = 5 $brandCondition $priceCondition $orderBy");

        // loops through all the db's rows and display the products for mens
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">';
          echo '<a id="main-link" href = "product-page.php?product_id=' . $row['ProductID'] . '"><div class="card" style="width: 18rem">';
          echo '<img src="' . $row['ImageUrl'] . '" class="card-img-top" alt="' . $row['ProductName'] . '">';
          echo '<div class="card-body">';
          echo '<p class="card-text">' . $row['ProductName'] . '</p>';
          echo '<p class="card-text"><strong>£' . $row['Price'] . '</strong></p>';
          echo '<input type="hidden" name="product-id" value="' . $row['ProductID'] . '">';
          echo '<button type="submit" name="add-to-cart" class="btn btn-dark add-to-cart">View Product</button>';
          echo '</div>';
          echo '</div></a>';
          echo '</div>';
        }
        ?>
      </div>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
  </script>

  <!-- Script to update the filters once the apply button is clicked-->
  <script>
    window.onload = function() {
      var urlParams = new URLSearchParams(window.location.search);
      var sortValue = urlParams.get('sort');
      var brandValue = urlParams.get('brand');
      var minPrice = urlParams.get('minPrice');
      var maxPrice = urlParams.get('maxPrice');

      if (sortValue) {
        document.querySelector("select[name='sort']").value = sortValue;
      }

      if (brandValue) {
        document.querySelector("select[name='brand']").value = brandValue;
      }

      if (minPrice) {
        document.querySelector("input[name='minPrice']").value = minPrice;
      }

      if (maxPrice) {
        document.querySelector("input[name='maxPrice']").value = maxPrice;
      }
    };

    function applyFilters() {
      var sortValue = document.querySelector("select[name='sort']").value;
      var brandValue = document.querySelector("select[name='brand']").value;
      var minPrice = document.querySelector("input[name='minPrice']").value;
      var maxPrice = document.querySelector("input[name='maxPrice']").value;

      var url = "products-men.php?sort=" + sortValue + "&brand=" + brandValue;

      if (minPrice !== "") {
        url += "&minPrice=" + minPrice;
      }

      if (maxPrice !== "") {
        url += "&maxPrice=" + maxPrice;
      }

      window.location.href = url;
    }
  </script>

  <!-- Footer Start -->
  <?php include('footer.php') ?>
  <!-- Footer End -->
</body>

</html>