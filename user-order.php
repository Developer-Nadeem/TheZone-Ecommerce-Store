<?php
session_start();

  if (!isset($_COOKIE['shopping_cart'])) {
    setcookie('shopping_cart', serialize(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
    setcookie('shopping_cart_json', json_encode(array()), time() + (86400), "/"); //Shopping cart cookie expires in a day
  }

  if (isset($_POST['add-to-cart'])) {
    $productId = $_POST['product-id'];

    $shopping_cart = isset($_COOKIE['shopping_cart']) ? unserialize($_COOKIE['shopping_cart']) : array();
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

    if (array_key_exists($productId, $shopping_cart)) {
      $shopping_cart[$productId] += $quantity;
    } else {
        $shopping_cart[$productId] = $quantity;
    };

    setcookie('shopping_cart', serialize($shopping_cart), time() + (86400), "/"); //Shopping cart cookie expires in a day
    setcookie('shopping_cart_json', json_encode($shopping_cart), time() + (86400), "/"); //Shopping cart cookie expires in a day
  }
// Checks if the user is logged in, if not it redirects you to the login/signup page
if (!isset($_SESSION['email'])) {
    header("Location: login-signup-page.php");
    exit();
}

$email = $_SESSION['email'];

// Include the database connection
include('connectiondb.php');

// Fetch orders for the logged-in user
$stmt = $db->prepare("SELECT orders.OrderID, orders.OrderTime, orders.OrderStatus, orders.TotalAmount FROM orders WHERE orders.UserID IN (SELECT UserID FROM useraccounts WHERE Email = ?)");
$stmt->execute([$email]);
$orders = $stmt->fetchAll();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Same head for a consistent format -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheZone</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!--Navbar Start-->
    <?php include('navbar.php') ?>
    <!--Navbar End-->

    <main>
        <div class="container">
            <a href="user-page.php" class="btn btn-primary">Back to User Page</a>
            <section style="overflow-x: auto; display: flex; justify-content: center;">
                <h1>Your Orders</h1>
            </section>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Time</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['OrderID']; ?></td>
                    <td><?php echo $order['OrderTime']; ?></td>
                    <td><?php echo $order['OrderStatus']; ?></td>
                    <td><?php echo $order['TotalAmount']; ?></td>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary edit-order" data-bs-toggle="modal"
                            data-bs-target="#editOrderModal"
                            data-order-id="<?php echo $order['OrderID']; ?>">Edit</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </main>

    <!-- Modal for editing order -->
    <div class='modal fade' id='editOrderModal' tabindex='-1' aria-labelledby='editOrderModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='editOrderModalLabel'>Cancel Order</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-DTqcqsmBzZVxxYNjQyO6C/iT+33HyHDpe1fUjT2p1aMfYw1n00Mj5F5U7X90fe7J" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-XewpXs1jfOs9V96vHMPhoLg2KIkz0V5LEpW6zBPPm3Ibl2O/AX9Rvd1JNJsaGJRa" crossorigin="anonymous">
    </script>

    <script>
    document.querySelectorAll('.cancel-order').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = button.getAttribute('data-order-id');
            document.getElementById('cancelOrderId').value = orderId;
        });
    });
    </script>

</html>