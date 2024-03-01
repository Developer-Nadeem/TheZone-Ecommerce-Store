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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../TheZone/style.css">
    <title>Inventory</title>
</head>

<body>
    <?php include('../TheZone/adminnavbar.php') ?>


    <main>
    
    <section>

    <!-- CustomerID, Customer Name,CustomerEmail/User, CustomerPassword,isAdmin  -->
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>RequestID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Request Time</th>
            </tr>
        </thead>

        <tbody>
            <?php
            include('../TheZone/connectiondb.php');

            $contacts = $db->prepare("SELECT * FROM contactrequests");
            $contacts->execute();

            foreach ($contacts as $contact) {
                echo "<tr>";
                echo "<td>" . $contact['RequestID'] . "</td>";
                echo "<td>" . $contact['Name'] . "</td>";
                echo "<td>" . $contact['Email'] . "</td>";
                echo "<td>" . $contact['Message'] . "</td>";
                echo "<td>" . $contact['RequestTime'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

    </main>
</body>