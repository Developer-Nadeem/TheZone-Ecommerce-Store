<?php
session_start();

// If the user is already logged in, it redirects them to the home page
if (isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}

$loginErrors = [];
$signupErrors = [];

// Checks to see if the error sessions have been set then unset
if (isset($_SESSION['emailError'])) {
  $loginErrors[] = $_SESSION['emailError'];
  unset($_SESSION['emailError']);
}

if (isset($_SESSION['passwordError'])) {
  $loginErrors[] = $_SESSION['passwordError'];
  unset($_SESSION['passwordError']);
}

if (isset($_SESSION['noInputError'])) {
  $loginErrors[] = $_SESSION['noInputError'];
  unset($_SESSION['noInputError']);
}

// signup errors
if (isset($_SESSION['fnameError'])) {
  $signupErrors[] = $_SESSION['fnameError'];
  unset($_SESSION['fnameError']);
}

if (isset($_SESSION['lnameError'])) {
  $signupErrors[] = $_SESSION['lnameError'];
  unset($_SESSION['lnameError']);
}

if (isset($_SESSION['noEmailInput'])) {
  $signupErrors[] = $_SESSION['noEmailInput'];
  unset($_SESSION['noEmailInput']);
}

if (isset($_SESSION['noPassError'])) {
  $signupErrors[] = $_SESSION['noPassError'];
  unset($_SESSION['noPassError']);
}

if (isset($_SESSION['noInputError'])) {
  $signupErrors[] = $_SESSION['noInputError'];
  unset($_SESSION['noInputError']);
}

if (isset($_SESSION['noConfirmPassInput'])) {
  $signupErrors[] = $_SESSION['noConfirmPassInput'];
  unset($_SESSION['noConfirmPassInput']);
}

if (isset($_SESSION['invalidEmail'])) {
  $signupErrors[] = $_SESSION['invalidEmail'];
  unset($_SESSION['invalidEmail']);
}

if (isset($_SESSION['passNoMatch'])) {
  $signupErrors[] = $_SESSION['passNoMatch'];
  unset($_SESSION['passNoMatch']);
}

if (isset($_SESSION['lengthError'])) {
  $signupErrors[] = $_SESSION['lengthError'];
  unset($_SESSION['lengthError']);
}

if (isset($_SESSION['caseError'])) {
  $signupErrors[] = $_SESSION['caseError'];
  unset($_SESSION['caseError']);
}

if (isset($_SESSION['numError'])) {
  $signupErrors[] = $_SESSION['numError'];
  unset($_SESSION['numError']);
}

if (isset($_SESSION['specialChar'])) {
  $signupErrors[] = $_SESSION['specialChar'];
  unset($_SESSION['specialChar']);
}

if (isset($_SESSION['emailExists'])) {
  $signupErrors[] = $_SESSION['emailExists'];
  unset($_SESSION['emailExists']);
}

if (isset($_SESSION['signupSuccess'])) {
  $signupSuccess = $_SESSION['signupSuccess'];
  unset($_SESSION['signupSuccess']);
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
  <style>
    .field {
      position: relative;
    }

    .password-wrapper {
      display: flex;
      align-items: center;
    }

    .password-wrapper input[type="password"] {
      flex: 1;
    }

    .show-password-login,
    .show-password-signup {
      margin-left: 5px;
      cursor: pointer;
      background-color: #2c2c2c;
      color: white;
      border-radius: 5px;
      padding: 5px;
      font-weight: bold;
      transition: 0.2s ease;

    }

    .show-password-login:hover,
    .show-password-signup:hover {
      background-color: white;
      color: #2c2c2c;
    }

    .error-msg {
      color: red;
      font-weight: bold;
    }

    .green-msg {
      color: green;
      font-weight: bold;
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
              <input type="text" name="email" placeholder="Email Address" style="height: 50px;">
            </div>
            <div class="field">
              <div class="password-wrapper">
                <input type="password" id="loginPassword" name="password" placeholder="Password" style="height: 50px;">
                <span class="show-password-login" onclick="loginTogglePassword()">Show</span>
              </div>
              <div class="error-msg">
                <?php
                foreach ($loginErrors as $loginError) {
                  echo $loginError;
                }
                ?>
              </div>
              <div class="green-msg">
                <?php
                if (!empty($signupSuccess)) {
                  echo $signupSuccess;
                }
                ?>
              </div>
            </div>
            <br>
            <br>
            <div class="pass-link"><a href="forgot-password-page.php">Forgot password?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Login" name="login">
              <input type="hidden" name="submitted" value="true" />
            </div>
            <div class="signup-link">Dont have an account? <a href="">Signup now</a></div>
          </form>

          <form method="post" action="signup.php" class="signup">
            <div class="field">
              <input type="text" name="fname" placeholder="First Name">
            </div>
            <div class="field">
              <input type="text" name="lname" placeholder="Last Name">
            </div>
            <div class="field">
              <input type="text" name="email" placeholder="Email Address">
            </div>
            <div class="field">
              <input type="password" id="password" name="password" placeholder="Password">
            </div>
            <div class="field">
              <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm password">
            </div>
            <br>
            <div>
              <span class="show-password-signup" onclick="signupTogglePassword()">Show</span>
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Signup" name="signup">
              <input type="hidden" name="submitted" value="true" />
            </div>
            <div class="error-msg">
              <?php
              foreach ($signupErrors as $signupError) {
                echo $signupError;
              }
              ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

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
    } else {
      loginPasswordInput.type = 'password';
      showPasswordSpanLogin.textContent = 'Show';
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
    } else {
      passwordInput.type = 'password';
      confirmPasswordInput.type = 'password';
      showPasswordSpanSignup.textContent = 'Show';
    }
  }

  document.addEventListener('DOMContentLoaded', (event) => {
    const loginForm = document.querySelector('form.login');
    const signupForm = document.querySelector('form.signup');
    const loginBtn = document.querySelector('label.login');
    const signupBtn = document.querySelector('label.signup');
    const signupLink = document.querySelector('form .signup-link a');

    signupBtn.onclick = () => {
      loginForm.style.marginLeft = '-50%';
    };

    signupLink.onclick = () => {
      signupBtn.click();
      return false;
    };

    loginBtn.onclick = () => {
      loginForm.style.marginLeft = '0%';
    };

    <?php if (!empty($signupErrors)) { ?>
      signupBtn.click();

    <?php } ?>

  })
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>