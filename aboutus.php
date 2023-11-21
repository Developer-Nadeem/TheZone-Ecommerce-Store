<!doctype html>
<html lang="en">

<head>
    <!-- Same head for a consistent format -->
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
        </div>

      </div>
    </nav>
  </header>
  <!-- Nav bar end -->
  <main>
    <!-- first sectioin with lefet aligned text placed onto an image -->
    <section>

      <div class="container-fluid hero">

        <img class="img-fluid hero-img" src="..\TheZone\images\fashionable-men-jacket-hanging-clothing-store-generated-by-ai.jpg"
          alt="heropage">
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
        <img class="img-fluid" src="..\TheZone\images\young-black-spanish-male-friends-standing-front-blue-metal-gate.jpg"
          alt="heropage">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
</body>
</html>