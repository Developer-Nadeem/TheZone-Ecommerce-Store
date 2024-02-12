<?php
session_start();
include('../TheZone/connectiondb.php');

if (isset($_POST['removeUserID'])) {
    try {
        $userID = $_POST['removeUserID'];
        $deleteUser = $db->prepare("DELETE FROM useraccounts WHERE UserID = :userID");
        $deleteUser->bindParam(':userID', $userID);
         $deleteUser->execute();
    
         header("Location: ../TheZone/admin-customers.php");
        exit();
    } catch (PDOException $ex) {
        echo "<p>Sorry, a database error occurred.</p>". $ex->getMessage();
    }
}
?>