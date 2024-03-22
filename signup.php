<?php
session_start();

//checks if the signup form has been submitted
if (isset($_POST['submitted'])) {
    require("connectiondb.php");

    // Validate and sanatise the inputs
    $fname = isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : false;
    $lname = isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : false;
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : false;
    $pass = isset($_POST['password']) ? trim($_POST['password']) : false;
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : false;

    if (!($fname)) {
        $_SESSION['fnameError'] = "Please enter your first name";
        header("Location: login-signup-page.php");
        exit();
    }

    if (!($lname)) {
        $_SESSION['lnameError'] = "Please enter your last name";
        header("Location: login-signup-page.php");
        exit();
    }

    if (!($email)) {
        $_SESSION['noEmailInput'] = "Please enter your email address";
        header("Location: login-signup-page.php");
        exit();
    }

    if (!($pass)) {
        $_SESSION['noPassInput'] = "Please enter your password";
        header("Location: login-signup-page.php");
        exit();
    }

    if (!($confirm_password)) {
        $_SESSION['noConfirmPassInput'] = "Please confirm your password";
        header("Location: login-signup-page.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['invalidEmail'] = "Please enter a valid email";
        header("Location: login-signup-page.php");
        exit();
    }

    if ($pass !== $confirm_password) {
        $_SESSION['passNoMatch'] = "Password and Confirm Password do not match";
        header("Location: login-signup-page.php");
        exit();
    }

    if (strlen($pass) < 8) {
        $_SESSION['lengthError'] = "Password should be at least 8 characters long";
        header("Location: login-signup-page.php");
        exit();
    }

    if (!preg_match('/[a-z]/', $pass) || !preg_match('/[A-Z]/', $pass)) {
        $_SESSION['caseError'] = "Your password must contain at least one lower case and upper case character";
        header("Location: login-signup-page.php");
        exit();
    }

    if (!preg_match('/[0-9]/', $pass)) {
        $_SESSION['numError'] = "Password must contain at least one number";
        header("Location: login-signup-page.php");
        exit();
    }

    if (preg_match('/[\s\0\'"`]/', $pass)) {
        $_SESSION['specialChar'] = "Your password must not contain any empty spaces, single quotes, double quotes or backticks";
        header("Location: login-signup-page.php");
        exit();
    }

    $checkEmail = $db->prepare("SELECT COUNT(*) FROM useraccounts WHERE Email = :email");
    $checkEmail->bindParam(':email', $email);
    $checkEmail->execute();
    $emailExists = $checkEmail->fetchColumn();

    if ($emailExists) {
        $_SESSION['emailExists'] = "The email has already been registered";
        header("Location: login-signup-page.php");
        exit();
    }

    $passHash = password_hash($pass, PASSWORD_DEFAULT);

    try {
        $stmt = $db->prepare("INSERT INTO useraccounts (Firstname, Lastname, Email, Pass) VALUES (:fname, :lname, :email, :password)");

        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passHash);

        $stmt->execute();
        $_SESSION['signupSuccess'] = "Registration successful! You can now log in";
        header("Location: login-signup-page.php");
        exit();
    } catch (PDOException $e) {
        echo "Sorry, a database error occurred! <br>";
        echo "Error details: <em>" . $e->getMessage() . "</em>";
    }
}
