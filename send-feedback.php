<?php 

include ("../TheZone/connection.db");

if(isset($_POST['submitted']) && !empty(trim($_POST['feedback-box']))){
    try{
        $addReview = $db->prepare("INSERT INTO reviews VALUES ('', :ProductID, :Rating, :Description,:UserID)");
        $addReview -> bindParam(':$productID',$product);




    }

}











?>