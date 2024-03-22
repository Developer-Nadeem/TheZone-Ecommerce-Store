<?php
session_start();

// If the user is already logged in, it redirects them to the home page
if (isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}
// Checks to see if the errors have been stored for the login form
$emailError = isset($_SESSION['emailError']) ? $_SESSION['emailError'] : '';
$passwordError = isset($_SESSION['passwordError']) ? $_SESSION['passwordError'] : '';
$noInputError = isset($_SESSION['noInputError']) ? $_SESSION['noInputError'] : '';

// Checks to see if the errors have been stored for the signup form

$fnameError = isset($_SESSION['fnameError']) ? $_SESSION['fnameError'] : '';
$lnameError = isset($_SESSION['lnameError']) ? $_SESSION['lnameError'] : '';
$noEmailInput = isset($_SESSION['noEmailInput']) ? $_SESSION['noEmailInput'] : '';
$noPassInput = isset($_SESSION['noPassInput']) ? $_SESSION['noPassInput'] : '';
$noConfirmPassInput = isset($_SESSION['noConfirmPassInput']) ? $_SESSION['noConfirmPassInput'] : '';
$invalidInput = isset($_SESSION['invalidEmail']) ? $_SESSION['invalidEmail'] : '';
$passNoMatch = isset($_SESSION['passNoMatch']) ? $_SESSION['passNoMatch'] : '';
$lengthError = isset($_SESSION['lengthError']) ? $_SESSION['lengthError'] : '';
$caseError = isset($_SESSION['caseError']) ? $_SESSION['caseError'] : '';
$numError = isset($_SESSION['numError']) ? $_SESSION['numError'] : '';
$specialChar = isset($_SESSION['specialChar']) ? $_SESSION['specialChar'] : '';
$emailExists = isset($_SESSION['emailExists']) ? $_SESSION['emailExists'] : '';
$signupSuccess = isset($_SESSION['signupSuccess']) ? $_SESSION['signupSuccess'] : '';


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

    .show-password-login, .show-password-signup {
      margin-left: 5px;
      cursor: pointer;
      background-color: #2c2c2c;
      color: white;
      border-radius: 5px;
      padding: 5px;
      font-weight: bold;
      transition: 0.2s ease;
      
    }

    .show-password-login:hover, .show-password-signup:hover {
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
                <?php if (!empty($passwordError)) {
                  echo $passwordError;
                }
                if (!empty($emailError)) {
                  echo $emailError;
                }
                if (!empty($noInputError)) {
                  echo $noInputError;
                } ?>
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
              <input type="text" name="fname" placeholder="First Name">
              <?php if (!empty($fnameError)) {
                echo $fnameError;
              } ?>
            </div>
            <div class="field">
              <input type="text" name="lname" placeholder="Last Name">
              <?php if (!empty($lnameError)) {
                echo $lnameError;
              } ?>
            </div>
            <div class="field">
              <input type="text" name="email" placeholder="Email Address">
              <?php if (!empty($noEmailInput)) {
                echo $noEmailInput;
              }
              if (!empty($invalidEmail)) {
                echo $invalidEmail;
              }
              ?>
            </div>
            <div class="field">
              <input type="password" id="password" name="password" placeholder="Password">
              <?php if (!empty($noPassInput)) {
                echo $noPassInput;
              } ?>
            </div>
            <div class="field">
              <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm password">
              <?php if (!empty($noConfirmPassInput)) {
                echo $noConfirmPassInput;
              } ?>
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
            <?php
            if (!empty($passNoMatch)) {
              echo $passNoMatch;
            }
            if (!empty($lengthError)) {
              echo $lengthError;
            }
            if (!empty($caseError)) {
              echo $caseError;
            }
            if (!empty($specialChar)) {
              echo $specialChar;
            }
            if (!empty($numError)) {
              echo $numError;
            }
            if (!empty($emailExists)) {
              echo $emailExists;
            }
            ?>
          </form>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer Start -->
  <?php include('footer.php') ?>
  <!-- Footer End -->

  <?php
  unset($_SESSION['emailError']);
  unset($_SESSION['passwordError']);
  unset($_SESSION['noInputError']);
  unset($_SESSION['fnameError']);
  unset($_SESSION['lnameError']);
  unset($_SESSION['noEmailInput']);
  unset($_SESSION['noPassInput']);
  unset($_SESSION['nonConfirmPassInput']);
  unset($_SESSION['invalidEmail']);
  unset($_SESSION['passNoMatch']);
  unset($_SESSION['lengthError']);
  unset($_SESSION['caseError']);
  unset($_SESSION['specialChar']);
  unset($_SESSION['numError']);
  unset($_SESSION['emailExists']);
  unset($_SESSION['signupSuccess']);
  ?>

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