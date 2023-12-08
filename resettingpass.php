<!-- this php file is to be used to access the database and reset the password of the user -->
<!-- this file takes data from the reset password form in resetpass.php -->

<?php

// Check if the form is submitted
if (isset($_POST['submitted'])) {
    require("connectiondb.php");

    // Retrieve user input from the form
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $newPassword = isset($_POST['newPassword']) ? trim($_POST['newPassword']) : false;
    $confirmPassword = isset($_POST['confirmPassword']) ? ($_POST['confirmPassword']) : false;
    $passHash = password_hash($newPassword, PASSWORD_DEFAULT);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
        exit;
    }

    //Checks if the email entered has been registered into the database
    $checkEmail = $db->prepare("SELECT COUNT(*) FROM useraccounts WHERE Email = :email");
    $checkEmail->bindParam(':email', $email);
    $checkEmail->execute();
    $emailExists = $checkEmail->fetchColumn();

    if (!$emailExists) {
        echo "The email has not been registered";
        exit;
    }

    try {
        // Updates the user's password with the new password
        $stmt = $db->prepare("UPDATE useraccounts SET Pass = :newPassword WHERE Email = :email");

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':newPassword', $passHash);

        $stmt->execute();
        echo "Password updated successfully.";
        echo '<script> setTimeout(function(){ window.location.href = "login-signup-page.php"; }, 2000);  </script>';

    } catch (PDOException $e) {
        echo "Sorry, a database error occurred! <br>";
        echo "Error details: <em>" . $e->getMessage() . "</em>";
    }
}

?>