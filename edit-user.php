<?php
session_start();
include('../TheZone/connectiondb.php');

if(isset($_POST['editUser'])) {
    $error = "";
    if (!empty(trim($_POST['editUserName'])) && !empty(trim($_POST['editUserEmail'])) && !empty(trim($_POST['editUserPassword'])) && isset($_SESSION['CSRF_Token']) && $_SESSION['CSRF_Token'] === $_POST['csrftoken']) {
        try {
            $userID = $_POST['editUserID'];
            $userName = trim($_POST['editUserName']);
            $userEmail = trim($_POST['editUserEmail']);
            $userPassword = trim($_POST['editUserPassword']);

            $updateUser = $db->prepare("UPDATE useraccounts SET Firstname=:userName, Email=:userEmail, Pass=:userPassword WHERE UserID = :userID");
            $updateUser->bindParam(':userName', $userName);
            $updateUser->bindParam(':userEmail', $userEmail);
            $updateUser->bindParam(':userPassword', $userPassword);
            $updateUser->bindParam(':userID', $userID);
            $updateUser->execute();

            header("Location: admin-customers.php");
            exit();
        } catch (PDOException $ex) {
            echo "<p> Sorry, a database error occurred.</p>". $ex->getMessage();
        }
    } else {
        echo "Error: CSRF Token validation failed.";
    }
}
?>