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
    <title>Customer details</title>
</head>

<body>
    <?php include('../TheZone/adminnavbar.php') ?>

    <?php

    if (!isset($_SESSION['CSRF_Token'])) {
        $_SESSION['CSRF_Token'] = bin2hex(random_bytes(32));
    }
    $CSRFToken = $_SESSION['CSRF_Token'];

    ?>

    <!-- pop up modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User:</h5>
                    <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../TheZone/edit-user.php" method="post">
                    <div class="modal-body">
        
                            <div class="form-group">
                                <label for="editUserID" >User ID</label>
                                <input type="text" name="editUserID" class="form-control" id="editUserID" style="pointer-events:none;">
                            </div>

                        <div class="form-group">
                            <label for="editFirstName"> Edit First Name</label>
                            <input required type="text" class="form-control" name="editFirstName" id="editFirstName"
                                placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="editLastName"> Edit Last Name</label>
                            <input required type="text" class="form-control" name="editLastName" id="editLastName"
                                placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="editUserEmail">Edit Email</label>
                            <input required type="email" class="form-control" name="editUserEmail" id="editUserEmail"
                                placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="editUserPassword">New Password</label>
                            <input required type="password" class="form-control" name="editUserPassword"
                                id="editUserPassword" placeholder="Enter new password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="csrftoken" value="<?php echo $CSRFToken ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="submitted" id="submitted">
                        <button type="submit" name="updatedata" class="btn btn-secondary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal end -->




    <section>

        <!-- CustomerID, Customer Name,CustomerEmail/User, CustomerPassword,isAdmin  -->
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>CustomerID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>isAdmin?</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include('../TheZone/connectiondb.php');

                $users = $db->prepare("SELECT * FROM useraccounts");
                $users->execute();

                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['UserID'] . "</td>";
                    echo "<td>" . $user['Firstname'] . " " . $user['Lastname'] . "</td>";
                    echo "<td>" . $user['Email'] . "</td>";
                    echo "<td>" . $user['Pass'] . "</td>";
                    echo "<td>" . ($user['isAdmin'] ? 'Yes' : 'No') . "</td>";
                    echo "<td>";
                    echo "<button type='button' class='btn btn-primary editbtn' data-userid='" . $user['UserID'] . "' data-firstname='" . $user['Firstname'] . "' data-lastname='" . $user['Lastname'] . "' data-useremail='" . $user['Email'] . "' data-userpassword='" . $user['Pass'] . "'>EDIT</button>";


                    echo "<form style='display: inline-block;' action='../TheZone/remove-user.php' method='post'>";
                    echo "<input type='hidden' name='removeUserID' value='" . $user['UserID'] . "'>";
                    echo "<button type='submit' class='btn btn-danger'>REMOVE</button>";
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
        $(document).ready(function () {
            $('.editbtn').click(function () {
                $('#editmodal').modal('show');
                console.log('Edit button clicked');

                var userID = $(this).data('userid');
                var firstname = $(this).data('firstname');
                var userEmail = $(this).data('useremail');
                var userPassword = $(this).data('userpassword');
                var lastname = $(this).data('lastname');


                console.log('User ID:', userID);
                console.log('First Name:', firstname);
                console.log('User Email:', userEmail);
                console.log('User Password:', userPassword);
                console.log('lastname:', lastname);


                $('#editUserID').val(userID);
                $('#editFirstName').val(firstname);
                $('#editLastName').val(lastname);
                $('#editUserEmail').val(userEmail);
                $('#editUserPassword').val(userPassword);
            });
        });
    </script>

</body>

</html>