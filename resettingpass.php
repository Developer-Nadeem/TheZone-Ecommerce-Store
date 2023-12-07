<!-- this php file is to be used to access the database and reset the password of the user -->
<!-- this file takes data from the reset password form in resetpass.php -->

<?php
session_start();

require("connectiondb.php");

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    // Redirect to the login page if not logged in
    header("Location: login-signup-page.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the form
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    // retrieving the email of the user from the session as a session variable
    $email = $_SESSION['email'];

    // hashing the new password before updating the database
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // updating the password in the record of the user
    $updatePasswordQuery = "UPDATE useraccounts SET Pass = ? WHERE Email = ?";
    $stmt = $conn->prepare($updatePasswordQuery);
    $stmt->bind_param("si", $hashedPassword, $email);

    if ($stmt->execute()) {
        // displaying a pop up message for successful password change
        echo '<script>alert("Password updated successfully.");</script>';
        // password successfully updated and user is redirected to home page
        header("Location: index.php");
        echo "Password updated successfully.";
    } else {
        // error updating password
        echo "Error updating password: " . $stmt->error;
        // redirection back to the reset password page
        header("resetpass-page.php");
    }

    // closing the statement
    $stmt->close();
}

// // closing the database connection
// $conn->close();
?>