<?php
    require("connectiondb.php");

    if (!isset($_POST['discount_code'])) {
        $response = "You have not entered a discount code.";
        header('Content-Type: application/json');
        echo json_encode($response);
        return;
    }

    $discountCode = $_POST['discount_code'];

    $stmt = $db->prepare("SELECT * FROM discount_codes WHERE LOWER(discount_code) = LOWER(:discountCode)");
    $stmt->bindValue(':discountCode', $discountCode);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $response = array(
            "success" => true,
            "discount_percentage" => $row['discount_percentage']
        );

        $_COOKIE['discount_code'] = $discountCode;
        $_COOKIE['discount_percentage'] = $row['discount_percentage'];
    } else {
        $response = "Invalid discount code";
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>