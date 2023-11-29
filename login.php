<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheZone</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      body {
        background-image: url('images/login_page_background.jpg');
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
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
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
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

  <main>

    <div class="page-container">
        <div class="login-container">

            <form class="login-form" id="loginForm" action="loggingIn.php" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                    <span class="show-password" onclick="togglePassword()">Show</span>
                </div>

                <input type="submit" value="Login">
                <p class="links"><a href="#">Forgot password?</a></p>
                <p class="links"><a href="signup.html">Don't have an account? Create one</a></p>
            </form>
            
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const showPasswordSpan = document.querySelector('.show-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showPasswordSpan.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                showPasswordSpan.textContent = 'Show';
            }
        }
    </script>
  </main>