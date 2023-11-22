<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TheZone</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
  <!--Navbar Start-->
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
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
                <li><a class="dropdown-item" href="#">Mens</a></li>
                <li><a class="dropdown-item" href="#">Womens</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Kids</a></li>
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
      <!-- adding in shopping cart button/icon then this will redirect page to basket and view all items
    will have the following: increase and decrease quanitity, remove item, continue shopping, proceed to checkout, personal details
  choose to login or continue as a guest. Also, Create a drop down menu when hovering over cart to view products or go to checkout and enter personal details. -->
      
       

      </div>
    </nav>
  </header>

  <!--Navbar End-->


  <main>
    <!-- Hero page -->
    <section>
      <div class="container-fluid hero">
        <img class="img-fluid hero-img" src="..\TheZone\images\young-woman-sitting-leaning-standing-man2.jpg"
          alt="heropage">
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

    <!--Best sellers -->

    <section>
      <div class="container my-5 best-sellers">
        <div class="row">
          <div class="col productbox">
            <div class="product border"><img class="img-fluid" src="..\TheZone\images\product.webp" alt="prduct"></div>
          </div>
          <div class="col productbox">
            <div class="product border"><img class="img-fluid" src="..\TheZone\images\product.webp" alt="prduct"></div>
          </div>
          <div class="col productbox">
            <div class="product border"><img class="img-fluid" src="..\TheZone\images\product.webp" alt="prduct"></div>
          </div>
          <div class="col productbox">
            <div class="product border"><img class="img-fluid" src="..\TheZone\images\product.webp" alt="prduct"></div>
          </div>
        </div>
        
        <div class="row">
          <div class="col productbox">
            <div class="product border"><img class="img-fluid" src="..\TheZone\images\product.webp" alt="prduct"></div>
          </div>
          <div class="col productbox">
            <div class="product border"><img class="img-fluid" src="..\TheZone\images\product.webp" alt="prduct"></div>
          </div>
          <div class="col productbox">
            <div class="product border"><img class="img-fluid" src="..\TheZone\images\product.webp" alt="prduct"></div>
          </div>
          <div class="col productbox">
            <div class="product border"><img class="img-fluid" src="..\TheZone\images\product.webp" alt="prduct"></div>
          </div>

        </div>
      </div>


    </section>


  </main>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
</body>

</html>