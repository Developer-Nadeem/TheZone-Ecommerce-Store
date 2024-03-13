<?php
session_start();
include('connectiondb.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $cardholderName = $_POST['cardholderName'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    // Add any additional validation or sanitization here as needed

    // Check if the user has existing payment details
    $email = $_SESSION['email'];
    $stmt = $db->prepare("SELECT * FROM paymentdetails WHERE Email = ?");
    $stmt->execute([$email]);
    $existingPaymentDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existingPaymentDetails) {
        // If user does not have existing payment details, insert new details
        $stmt = $db->prepare("INSERT INTO paymentdetails (Email, CardholderName, CardNumber, ExpiryDate) VALUES (?, ?, ?, ?)");
        $stmt->execute([$email, $cardholderName, $cardNumber, $expiryDate]);
    } else {
        // If user has existing payment details, update them
        $stmt = $db->prepare("UPDATE paymentdetails SET CardholderName = ?, CardNumber = ?, ExpiryDate = ? WHERE Email = ?");
        $stmt->execute([$cardholderName, $cardNumber, $expiryDate, $email]);
    }

    // Redirect the user back to the user-page.php after updating payment details
    header("Location: user-page.php");
    exit();
}
?>