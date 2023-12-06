<?php
session_start();
  if (isset($_POST['add-to-cart'])) {
    $productId = $_POST['product-id'];

    $shoppingCart = isset($_COOKIE['shopping_cart']) ? unserialize($_COOKIE['shopping_cart']) : array();

    array_push($shoppingCart, $productId);

    setcookie('shopping_cart', serialize($shoppingCart), time() + (86400), "/"); //Shopping cart cookie expires in a day

    echo $_COOKIE['shopping_cart']; //For testing purposes until shopping cart page made
  }
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Same head for a consistent format -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TheZone</title>
  <link rel="stylesheet" href="..\TheZone\style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!--Navbar Start-->
  <?php include('..\TheZone\\navbar.php')?>
  <!--Navbar End-->


  <main>
    <!-- Hero page -->
    <section>
      <div class="container-fluid hero">
        <img class="img-fluid hero-img" src="..\TheZone\images\young-woman-sitting-leaning-standing-man2.jpg" alt="heropage">
        <div class="txt">
          <h1 id="hero-text">The classics, elevated.</h1>
          <h4 id="hero-subtext">Seasonless style designed with<br>ultimate comfort in mind.</h4>
          <a id="hero-btn" href="#">SHOP NOW</a>
        </div>
      </div>
    </section>

    <!-- Menus -->
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col menubox"><img class="img-fluid menu" src="..\TheZone\images\Mens.jpg" alt="Mens"><a class="labels" href="#">Mens</a></div>
          <div class="col menubox"><img class="img-fluid menu" src="..\TheZone\images\Womens.jpg" alt="Womens"><a class="labels" href="#">Womens</a></div>
          <div class="col menubox"><img class="img-fluid menu" src="..\TheZone\images\Kid.jpg" alt="kids"><a class="labels" href="#">Kids</a></div>
        </div>
      </div>
    </section>

    <section class="best-selling">
      <div class="container-fluid">
        <header class="title">Best-selling</header>
        <div class="row item-boxes">
          <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product1.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
                <div>
                  <form method="post">
                      <input type="hidden" name="product-id" value="product1">
                      <button type="submit" name='add-to-cart' class="btn btn-primary add-to-cart">Add To Cart</button>
                  </form>
                </div>
            </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product2.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
                <div>
                  <form method="post">
                      <input type="hidden" name="product-id" value="product2">
                      <button type="submit" name='add-to-cart' class="btn btn-primary add-to-cart">Add To Cart</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product3.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
                <div>
                  <form method="post">
                      <input type="hidden" name="product-id" value="product3">
                      <button type="submit" name='add-to-cart' class="btn btn-primary add-to-cart">Add To Cart</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product4.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
                <div>
                  <form method="post">
                      <input type="hidden" name="product-id" value="product4">
                      <button type="submit" name='add-to-cart' class="btn btn-primary add-to-cart">Add To Cart</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="row item-boxes">
          <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product1.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product2.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product3.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product4.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- banner -->
    <section>
      <div class="container-fluid banner">
        <img class="img-fluid" src="..\TheZone\images\portrait-young-woman-dressed-hoodie-ripped-jeans-leaning-wall-while-sitting-skateboard-bridge-footway2.jpg" alt="banner">
        <div class="banner-txt">
          <h2>Ethics meet style.</h2>
          <h4>Effortless, elevated, easy-to-wear.</h4>
          <a id="banner-btn" href="#">SHOP NOW</a>
        </div>
      </div>
    </section>

    <section class="best-selling">
      <div class="container-fluid">
        <header class="title">COMING SOON</header>
        <div class="row item-boxes">
          <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product1.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product2.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="..\TheZone\images\product3.webp" alt="Card image cap">
              <div class="card-body">
                <p><strong>Product Title</strong></p>
                <p class="card-text">£10.99</p>
                <p><span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- social media -->
    <div data-mc-src="f7f1f169-7190-4a0c-826d-bcec4e85bfba#instagram"></div>
        
        <script 
          src="https://cdn2.woxo.tech/a.js#64346c2a36a38e7b470f83cd" 
          async data-usrc>
        </script>

  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  <!-- Footer Start -->
  <?php include('..\TheZone\footer.php') ?>
  <!-- Footer End -->

</body>

</html>