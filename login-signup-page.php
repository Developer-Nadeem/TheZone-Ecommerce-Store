<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Same head for a consistent format -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login or Signup</title>
  <link rel="stylesheet" href="..\TheZone\style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!--Navbar Start-->
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img class="img-fluid logo" src="../TheZone/images/logo-tp.png" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

  <main class="login-signup-page">
    <div class="form-wrapper">
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form method="post" action="login.php" class="login">
            <div class="field">
              <input type="text" name="email" placeholder="Email Address" required>
            </div>
            <div class="field">
              <input type="password" id="loginPassword" name="password" placeholder="Password" required>
            </div>
            <span class="show-password-login" onclick="loginTogglePassword()">Show</span>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Login" name="login">
              <input type="hidden" name="submitted" value="true" />
            </div>
            <div class="signup-link">Dont have an account? <a href="">Signup now</a></div>
          </form>

          <form method="post" action="signup.php" class="signup">
            <div class="field">
              <input type="text" name="fname" placeholder="First Name" required>
            </div>
            <div class="field">
              <input type="text" name="lname" placeholder="Last Name" required>
            </div>
            <div class="field">
              <input type="text" name="email" placeholder="Email Address" required>
            </div>
            <div class="field">
              <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="field">
              <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm password" required>
            </div>
            <div>
              <span class="show-password-signup" onclick="signupTogglePassword()">Show</span>
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Signup" name="signup">
              <input type="hidden" name="submitted" value="true" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

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

<script>
  function signupTogglePassword() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const showPasswordSpanSignup = document.querySelector('.show-password-signup');

    if (passwordInput.type && confirmPasswordInput.type === 'password') {
      passwordInput.type = 'text';
      confirmPasswordInput.type = 'text';
      showPasswordSpanSignup.textContent = 'Hide';
      showPasswordSpanSignup.classList.add('visible');
    } else {
      passwordInput.type = 'password';
      confirmPasswordInput.type = 'password';
      showPasswordSpanSignup.textContent = 'Show';
      showPasswordSpanSignup.classList.remove('visible');
    }
  }

  function loginTogglePassword() {
    const loginPasswordInput = document.getElementById('loginPassword');
    const showPasswordSpanLogin = document.querySelector('.show-password-login');

    if (loginPasswordInput.type === 'password') {
      loginPasswordInput.type = 'text';
      showPasswordSpanLogin.textContent = 'Hide';
      showPasswordSpanLogin.classList.add('visible');
    } else {
      loginPasswordInput.type = 'password';
      showPasswordSpanLogin.textContent = 'Show';
      showPasswordSpanLogin.classList.remove('visible');
    }
  }

  const loginForm = document.querySelector('form.login');
  const signupForm = document.querySelector('form.signup');
  const loginBtn = document.querySelector('label.login');
  const signupBtn = document.querySelector('label.signup');
  const signupLink = document.querySelector('form .signup-link a');

  signupBtn.onclick = () => {
    loginForm.style.marginLeft = '-50%';
  };

  loginBtn.onclick = () => {
    loginForm.style.marginLeft = '0%';
  };

  signupLink.onclick = () => {
    signupBtn.click();
    return false;
  };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
</html>