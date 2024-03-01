<?php
session_start();
include('../TheZone/connectiondb.php');

if(isset($_POST['submitted'])) {
    if (!empty(trim($_POST['editFirstName'])) && !empty(trim($_POST['editLastName']))  && !empty(trim($_POST['editUserEmail'])) && !empty(trim($_POST['editUserPassword'])) && isset($_SESSION['CSRF_Token']) && $_SESSION['CSRF_Token'] === $_POST['csrftoken']) {
        try {
            $userID = $_POST['editUserID'];
            $firstname = trim($_POST['editFirstName']);
            $lastname = trim($_POST['editLastName']);
            $userEmail = trim($_POST['editUserEmail']);
            $userPassword = password_hash(trim($_POST['editUserPassword']),PASSWORD_DEFAULT);
            

            $updateUser = $db->prepare("UPDATE useraccounts SET Firstname=:firstname, Lastname=:lastname, Email=:userEmail, Pass=:userPassword WHERE UserID = :userID");

            $updateUser->bindParam(':firstname', $firstname);
            $updateUser->bindParam(':lastname', $lastname);
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