<?php
session_start();

if (isset($_POST['submitted'])) {
  require("connectiondb.php");

  $newPass = isset($_POST['password']) ? ($_POST['password']) : false;
  $confirmPass = isset($_POST['confirm-password']) ? ($_POST['confirm-password']) : false;

  if (empty($newPass)) {
    $_SESSION['noInput1'] = "Please enter a new password";
    header("Location: user-change-password.php");
    exit();
  }

  if (empty($confirmPass)) {
    $_SESSION['noInput2'] = "Please confirm your password";
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
    header("Location: user-change-password.php");
    exit();
  }

  if (!preg_match('/[a-z]/', $newPass) || !preg_match('/[A-Z]/', $newPass)) {
    $_SESSION['passCaseError'] = "Your password must contain at least one lower case and upper case character";
    header("Location: user-change-password.php");
    exit();
  }

  if (!preg_match('/[0-9]/', $newPass)) {
    $_SESSION['passNumError'] = "Password must contain at least one number";
    header("Location: user-change-password.php");
    exit();
  }

  if (preg_match('/[\s\0\'"`]/', $newPass)) {
    $_SESSION['passSpecialCharError'] = "Your password must not contain any empty spaces, single quotes, double quotes or backticks";
    header("Location: user-change-password.php");
    exit();
  }

  $passHash = password_hash($newPass, PASSWORD_DEFAULT);

  try {
    $stmt = $db->prepare("UPDATE useraccounts SET Pass = :password WHERE Email = :email");

    $stmt->bindParam(':password', $passHash);
    $stmt->bindParam(':email', $_SESSION['email']);

    $stmt->execute();
    $_SESSION['success'] = "Your password has been changed";
    header("Location: user-change-password.php");
    exit();
  } catch (PDOException $e) {
    echo "Sorry, a database error occurred! <br>";
    echo "Error details: <em>" . $e->getMessage() . "</em>";
  }
}
