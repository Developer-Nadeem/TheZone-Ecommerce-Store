<?php
// Update payment details logic goes here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $cardholderName = $_POST['cardholderName'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];

   
    header("Location: user-page.php");
    exit();
}
?>