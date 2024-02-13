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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../TheZone/edit-user.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="editUserID" id="editUserID">
                        <div class="form-group">
                            <label for="editUserName"> Edit User Name</label>
                            <input required type="text" class="form-control" name="editUserName" id="editUserName" placeholder="Enter user name">
                        </div>
                        <div class="form-group">
                            <label for="editUserEmail">Edit Email</label>
                            <input required type="email" class="form-control" name="editUserEmail" id="editUserEmail" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="editUserPassword">New Password</label>
                            <input required type="password" class="form-control" name="editUserPassword" id="editUserPassword" placeholder="Enter new password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="csrftoken" value="<?php echo $CSRFToken ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="submitted" id="submitted">
                        <button type="submit" name="editUser" class="btn btn-primary">Save Changes</button>
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
                    echo "<button type='button' class='btn btn-primary editbtn' data-userid='" . $user['UserID'] . "' data-username='" . $user['Firstname'] . "' data-useremail='" . $user['Email'] . "' data-userpassword='" . $user['Pass'] . "'>EDIT</button>";
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
        $(document).ready(function() {
            $('.editbtn').click(function() {
                console.log('Edit button clicked');

                var userID = $(this).data('userid');
                var userName = $(this).data('username');
                var userEmail = $(this).data('useremail');
                var userPassword = $(this).data('userpassword');

                console.log('User ID:', userID);
                console.log('User Name:', userName);
                console.log('User Email:', userEmail);
                console.log('User Password:', userPassword);

                $('#editUserID').val(userID);
                $('#editUserName').val(userName);
                $('#editUserEmail').val(userEmail);
                $('#editUserPassword').val(userPassword);
            });
        });
    </script>

</body>

</html>