<?php

if (isset($_POST['submitted'])) {
  require("connectiondb.php");

  $email = isset($_POST['email']) ? $_POST['email'] : false;
  $currPass = isset($_POST['current-password']) ? trim($_POST['current-password']) : false;
  $newPass = isset($_POST['new-password']) ? ($_POST['new-password']) : false;
  $confrimPass = isset($_POST['confrim-password']) ? ($_POST['confirm-password']) : false;
  $passHash = password_hash($newPass, PASSWORD_DEFAULT);

  if (empty($email)) {
    $_SESSION['emptyEmail'] = "Please fill out the Email field";
    header("Location: user-change-password.php");
    exit();
  }

  if (empty($currPass)) {
    $_SESSION['emptyCurrPass'] = "Please Enter your current password";
    header("Location: user-change-password.php");
    exit();
  }

  if (empty($newPass)) {
    $_SESSION['newPass'] = "Please enter a new password";
    header("Location: user-change-password.php");
    exit();
  }

  if (empty($confirmPass)) {
    $_SESSION['confirmPass'] = "Please confirm your password";
    header("Location: user-change-password.php");
    exit();
  }

  if ($newPass !== $confirmPass) {
    $_SESSION['noMatch'] = "New Password and confirm password do not match";
    header("Location: user-change-password.php");
    exit();
  }

  if (strlen($newPass) < 8) {
    $_SESSION['passLengthError'] = "Password should be at least 8 characters long";
    header("Location: login-signup-page.php");
    exit();
  }

  if (!preg_match('/[a-z]/', $newPass) || !preg_match('/[A-Z]/', $newPass)) {
    $_SESSION['passCaseError'] = "Your password must contain at least one lower case and upper case character";
    header("Location: login-signup-page.php");
    exit();
  }

  if (!preg_match('/[0-9]/', $newPass)) {
    $_SESSION['passNumError'] = "Password must contain at least one number";
    header("Location: login-signup-page.php");
    exit();
  }

  if (preg_match('/[\s\0\'"`]/', $newPass)) {
    $_SESSION['passSpecialCharError'] = "Your password must not contain any empty spaces, single quotes, double quotes or backticks";
    header("Location: login-signup-page.php");
    exit();
  }

  // Looks through the useraccounts table to see if the email exists
  $checkEmail = $db->prepare("SELECT COUNT(*) FROM useraccounts WHERE Email = :email");
  $checkEmail->bindParam(':email', $email);
  $checkEmail->execute();
  $emailExists = $checkEmail->fetchColumn();

  // if the email does not exist
  if (!$emailExists) {
    $_SESSION['emailInvalid'] = "The email address you have entered either does not exist or is incorrect";
    header("Location: user-change-password.php");
    exit();
  }
}
