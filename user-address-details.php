<?php
session_start();

// Checks if the user is logged in, if not it redirects you to the login/signup page
if (!isset($_SESSION['email'])) {
    header("Location: login-signup-page.php");
    exit();
}

$email = $_SESSION['email'];

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
    <title>Your Address Details</title>
</head>

<body>
    <?php include('../TheZone/navbar.php') ?>
    <section style="overflow-x: auto; display: flex; justify-content: center;">
        <h1>Your Account</h1>
    </section>
    <section style="overflow-x: auto;">

        <!-- Address Details Table -->
        <table id="addressTable" class="table table-striped" style="width">
            <thead>
                <tr>
                    <th>Address Line 1</th>
                    <th>City</th>
                    <th>Postcode</th>
                    <th>Country</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../TheZone/connectiondb.php');

                // Fetch address details for the logged-in user
                $stmt = $db->prepare("SELECT ad.* FROM addressdetails ad INNER JOIN orders o ON ad.AddressID = o.AddressID INNER JOIN useraccounts ua ON o.UserID = ua.UserID WHERE ua.Email = ?");
                $stmt->execute([$email]);
                $addresses = $stmt->fetchAll();

                foreach ($addresses as $address) {
                    echo "<tr>";
                    echo "<td>" . $address['AddressLine1'] . "</td>";
                    echo "<td>" . $address['City'] . "</td>";
                    echo "<td>" . $address['Postcode'] . "</td>";
                    echo "<td>" . $address['Country'] . "</td>";
                    // Add Edit button with data attributes for address details
                    echo "<td><button type='button' class='btn btn-primary edit-address' data-bs-toggle='modal' data-bs-target='#editAddressModal' data-id='" . $address['AddressID'] . "'>Edit</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Edit Address Modal -->
    <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAddressModalLabel">Edit Address Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="update_address.php" method="POST">
                        <div class="mb-3">
                            <label for="addressLine1" class="form-label">Address Line 1</label>
                            <input type="text" class="form-control" id="addressLine1" name="addressLine1" value="">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="">
                        </div>
                        <div class="mb-3">
                            <label for="postcode" class="form-label">Postcode</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" value="">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="">
                        </div>
                        <!-- Hidden input field for storing address ID -->
                        <input type="hidden" id="addressID" name="addressID" value="">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {

        $('#addressTable').DataTable();

        // Edit Address Modal
        $('#addressTable').on('click', '.edit-address', function() {
            var addressLine1 = $(this).closest('tr').find('td:eq(0)').text();
            var city = $(this).closest('tr').find('td:eq(1)').text();
            var postcode = $(this).closest('tr').find('td:eq(2)').text();
            var country = $(this).closest('tr').find('td:eq(3)').text();
            var addressID = $(this).data('id');

            // Set values in the modal fields
            $('#addressLine1').val(addressLine1);
            $('#city').val(city);
            $('#postcode').val(postcode);
            $('#country').val(country);
            $('#addressID').val(addressID);
        });
    });
    </script>

    <style>
    #addressTable {
        width: 100%;
        margin-top: 20px;
    }

    #addressTable th,
    #addressTable td {
        padding: 12px 15px;
    }

    #addressTable th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    #addressTable tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #addressTable tbody tr:hover {
        background-color: #ddd;
    }

    @media (max-width: 768px) {
        #addressTable {
            width: 100%;
        }
    }

    .modal-content {
        border-radius: 10px;
        /* Rounded corners */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        /* Box shadow */
    }

    .modal-header {
        background-color: #f0f0f0;
        /* Header background color */
        border-bottom: none;
        /* Remove border */
    }

    .modal-body {
        padding: 20px;
        /* Add padding */
    }
    </style>

</body>

</html>