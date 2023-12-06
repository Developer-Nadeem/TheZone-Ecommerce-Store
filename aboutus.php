<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Same head for a consistent format -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About us</title>
  <link rel="stylesheet" href="..\TheZone\style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!--Navbar Start-->
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img class="img-fluid logo" src="../TheZone/images/logo-tp.png" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="aboutus.php">About Us</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Products
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="products.php">Mens</a></li>
                <li><a class="dropdown-item" href="products.php">Womens</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark" type="submit">Search</button>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item">
              <?php
              if (isset($_SESSION['email'])) {
                echo '<li><a href="logout.php" class="btn btn-outline-dark navbar-btn">Log Out</a></li>';
              } else {
                echo '<li><a href="login-signup-page.php"class="btn btn-outline-dark">Login/Signup</a></li>';
              }
              ?>
            </li>
          </ul>

        </div>
      </div>
    </nav>
  </header>

  <!--Navbar End-->
  <main>
    <!-- first sectioin with lefet aligned text placed onto an image -->
    <section>

      <div class="container-fluid hero">

        <img class="img-fluid hero-img" src="..\TheZone\images\fashionable-men-jacket-hanging-clothing-store-generated-by-ai.jpg" alt="heropage">
        <div class="txt" style="color: white; ">

          <h1 id="hero-text">The Zone. What is it About?</h1>
          <br>
          <h4 id="hero-subtext" style="font-weight:bold;">We're all about the effortless cool of 19-25-year-olds.<br> Our mission is simple: provide streetwear that looks and feels amazing.</h4>
          <br>
          <h4 id="hero-subtext" style="font-weight:bold;">Imagine strolling through the city in clothes that move with you.<br>That's the magic of The Zone.
            From casual hoodies to statement tees,<br> each piece is crafted to elevate your streetwear game.</h4>

        </div>

      </div>

    </section>

    <!-- Second section with right aligned text placed onto an image -->
    <section>

      <div class="container-fluid aboutsection">
        <img class="img-fluid" src="..\TheZone\images\cool-man-with-hoodie.jpg" alt="heropage">
        <div style="color: white;">
          <h1 id="aboutus-text"><br>The Zone isn't just about clothes.<br> It's a lifestyle.</h1>
          <h4 id="aboutus-text2">Join us where fashion meets comfort, and individuality meets community.
            <br><br> Stay tuned for the latest drops and exclusive vibes. Life's an adventure – let us outfit you for the ride
          </h4>
          <h1 id="aboutus-text2" style="top: 200%;">Your's Truly, The Zone</h1>
          <!-- Button to redirect user from the about us page to the products page for shopping -->
          <a style="position: absolute; top: 210%; left: 42%;" href="your-page-url" class="big-button" id="hero-btn">Discover Your True Style</a>
        </div>
      </div>

    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  <!-- Footer Start -->
  <footer class="footer bg-dark text-white">
  <br><br>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>About Us</h5>
        <p>Our Company is a leading provider of high-quality clothing. We strive to define street style for
          the upcoming generation.
        </p>
      </div>
      <div class="col-md-4">
        <h5>Contact Information</h5>
        <p>
          Address: Aston Street, The Zone<br>
          Phone: +44 123456789<br>
          Email: contactus@thezone.co.uk
        </p>
      </div>
      <div class="col-md-4">
        <h5>Follow Us</h5>
        <p>Stay connected with us on Instagram:</p>
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="https://www.instagram.com/thezzoneecom/" class="text-white" style="font-size: 30px;">
              <i class="fa fa-instagram"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <p class="text-center">
          &copy; 2023 The Zone. All rights reserved.
        </p>
      </div>
    </div>
  </div>
</footer>
  <!-- Footer End -->

</body>

</html>