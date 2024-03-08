<?php
session_start();

// Checks if the user is logged in, if not it redirects you to the login/signup page
if (!isset($_SESSION['email'])) {
    header("Location: login-signup-page.php");
    exit();
}

// Preforms another check to see if the logged in account is an admin, if not, it doesn't allow the user to access the page
if ($_SESSION['isAdmin'] !== 1) {
    echo '<h1 style="color:red;">Forbidden Access</h1>
    <p>You don\'t have permission to access this page</p>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheZone-CustomerInfo</title>
    <link rel="stylesheet" href="../TheZone/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Orders</title>
</head>

<body>
    <?php include('../TheZone/adminnavbar.php');

    if(!isset($_SESSION['CSRF_Token'])){
    $_SESSION['CSRF_Token'] = bin2hex(random_bytes(32));
    }
    $CSRFToken = $_SESSION['CSRF_Token'];
   
    ?>

    <section>
        <h2>Orders</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Order Time</th>
                    <th>Order Status</th>
                    <th>Total Amount</th>
                    <th>Payment ID</th>
                    <th>Address ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../TheZone/connectiondb.php');

                
                 $stmt = $db->query("SELECT * FROM orders");
                 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                     echo "<tr>";
                     echo "<td>" . $row['OrderID'] . "</td>";
                     echo "<td>" . $row['UserID'] . "</td>";
                     echo "<td>" . $row['OrderTime'] . "</td>";
                     echo "<td>" . $row['OrderStatus'] . "</td>";
                     echo "<td>" . $row['TotalAmount'] . "</td>";
                     echo "<td>" . $row['PaymentID'] . "</td>";
                     echo "<td>" . $row['AddressID'] . "</td>";
                     echo "<td>";
                     echo "<form action='../TheZone/update-order.php' method='post'>";
                     echo "<input type='hidden' name='orderID' value='" . $row['OrderID'] . "'>";
                     echo "<select class='form-select' name='orderStatus'>";
                     echo "<option value='Processing'>Processing</option>";
                     echo "<option value='Shipped'>Shipped</option>";
                     echo "<option value='Delivered'>Delivered</option>";
                     echo "</select>";
                     echo "<input type='hidden' name='submitted' id='submitted'>";
                     echo "<button type='submit' class='btn btn-primary'>Update</button>";
                     echo "</form>";
                     echo "</td>";
                     echo "</tr>";
                 }
                 ?>
            </tbody>
        </table>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>


    <script>
    $(document).ready(function() {
        $('.editbtn').click(function() {
            console.log('Edit button clicked');

            var orderID = $(this).data('orderid');
            var newStatus = $('#status_' + orderID).val();

            console.log('Order ID:', orderID);
            console.log('New Status:', newStatus);

            $.ajax({
                type: 'POST',
                url: 'update-order.php',
                data: {
                    orderID: orderID,
                    orderStatus: newStatus
                },
                success: function(response) {
                    console.log(response);

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);

                }
            });
        });
    });
    </script>


</body>

</html>