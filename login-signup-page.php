<?php
session_start();

// If the user is already logged in, it redirects them to the home page
if (isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Same head for a consistent format -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login or Signup</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

  <!-- Adds the popup CSS so this is what displays the popup on signup -->
  <style>
    .popup-container {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(0, 0, 0, 0.5);
      width: 100%;
      height: 100%;
    }

    .popup-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      text-align: center;
    }

    .close-popup {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <!--Navbar Start-->
  <?php include('navbar.php') ?>
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
            <div class="pass-link"><a href="resetpass-page.php">Forgot password?</a></div>
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

  <!-- This is the popup container for Signup -->
  <div id="signup-success-popup" class="popup-container">
    <div class="popup-content">
      <span class="close-popup" onclick="closePopup()">&times;</span>
      <!-- popup message -->
      <p>Registration successful! Redirecting to the homepage...</p>
    </div>
  </div>

  <!-- Footer Start -->
  <?php include('footer.php') ?>
  <!-- Footer End -->

  <!--bootstrap javascript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>

<script>
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

  
  function showPopup(popupId) {
    var popup = document.getElementById(popupId);
    popup.style.display = 'block';

    setTimeout(function() {
      popup.style.display = 'none';
    }, 3000); // 
  }

  document.addEventListener('DOMContentLoaded', function() {
    <?php
    if (isset($_SESSION['signup_success']) && $_SESSION['signup_success']) {
      echo 'showPopup();';
      unset($_SESSION['signup_success']);
    }
    ?>
  });

  function closePopup() {
    var popup = document.getElementById('signup-success-popup');
    popup.style.display = 'none';
  };

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>