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
        echo "Please enter your first name";
        exit;
    }

    if (!($lname)) {
        echo "Please enter your last name";
        exit;
    }

    if (!($email)) {
        echo "Please enter your email address";
        exit;
    }

    if (!($pass)) {
        echo "Please enter a password";
        exit;
    }

    if (!($confirm_password)) {
        echo "Please re-enter your password";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
        exit;
    }

    if ($pass !== $confirm_password) {
        echo "Password and confirm password do not match.";
        exit;
    }

    $checkEmail = $db->prepare("SELECT COUNT(*) FROM useraccounts WHERE Email = :email");
    $checkEmail->bindParam(':email', $email);
    $checkEmail->execute();
    $emailExists = $checkEmail->fetchColumn();

    if ($emailExists) {
        echo "This email has already been registered. Please enter a different email address.";
        exit;
    }

    $passHash = password_hash($pass, PASSWORD_DEFAULT);

    try {
        $stmt = $db->prepare("INSERT INTO useraccounts (Firstname, Lastname, Email, Pass) VALUES (:fname, :lname, :email, :password)");

        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passHash);

        $stmt->execute();
        echo "Registration successful!";
        // This part redirects you to the homepage after 3 seconds which is index.php
        echo '<script> setTimeout(function(){ window.location.href = "index.php"; }, 3000);  </script>';
        exit;
    } catch (PDOException $e) {
        echo "Sorry, a database error occurred! <br>";
        echo "Error details: <em>" . $e->getMessage() . "</em>";
    }
}
