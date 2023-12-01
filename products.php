<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Same head for a consistent format -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheZone - Products</title>
    <link rel="stylesheet" href="..\TheZone\style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar Start -->
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img class="img-fluid logo" src="../TheZone/images/logo-tp.png" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="aboutus.php">About Us</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Products
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="products.php">Mens</a></li>
                <li><a class="dropdown-item" href="products.php">Womens</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="products.php">Kids</a></li>
              </ul>
            </li>

          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark" type="submit">Search</button>
          </form>
          <div>
        <button>Shopping</button> 
      </div>
        </div>

      </div>
    </nav>
  </header>
    <!-- Navbar End -->

    <main>
      <div class="container mt-6">
        <div class="row">
          <?php
          // gets the db
          include("connectiondb.php");

          //gets all from products
          $stmt = $db->query("SELECT * FROM products");

          //loops through all the db's rows and display the products
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo'<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3"">';
              echo'<div class="card" style="width: 18rem">';
                echo'<img src="..\TheZone\images\\'.$row['imageUrl'].'" class="card-img-top" alt="'.$row['ProductName'].'">';
                echo'<div class="card-body">';
                  echo'<p class="card-text">'.$row['ProductName'].'</p>';
                  echo'<p class="card-text"><Strong>£'.$row['Price'].'</Strong></p>';
                echo'</div>';
              echo'</div>';
            echo'</div>';
          }

          ?>
        </div>
      </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous">
    </script>
</body>

</html>
