<!doctype html>
<html lang="en">

<head>
    <!-- Same head for a consistent format -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="resetpass-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Password Reset</title>
    <script>
        function validatePassword() {
            var newPassword = document.getElementById("newPassword").value;
            var confirmNewPassword = document.getElementById("confirmNewPassword").value;

            if (newPassword !== confirmNewPassword) {
                alert("New password and confirm new password do not match. Please re-enter.");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <!--Navbar Start-->
    <?php include('..\TheZone\\navbar.php') ?>
    <!--Navbar End-->

    <!-- Main section of the changing password form -->
    <main>
        <div style="text-align: center; margin-top: 25px;">
            <h2>Password Reset</h2>
        </div>
        <div class="changepass-container">
            <form onsubmit="return validatePassword()" method="post" action="resettingpass.php">

                <label class="changepass-label" for="email">Email:</label>
                <div class="cfield">
                    <input class="changepass-input" type="text" id="email" name="email" required><br>
                </div>

                <label class="changepass-label" for="newPassword">New Password:</label>
                <div class="cfield">
                    <input class="changepass-input" type="password" id="newPassword" name="newPassword" required><br>
                </div>

                <label class="changepass-label" for="confirmNewPassword">Confirm New Password:</label>
                <div class="cfield">
                    <input class="changepass-input" type="password" id="confirmNewPassword" name="confirmNewPassword" required><br>
                </div>

                <div style="text-align: center;">
                    <input class="changepass-input-submit" type="submit" value="Reset Password">
                    <input type="hidden" name="submitted" value="true" />
                </div>
            </form>
        </div>
    </main>
    <!-- needed for drop down menu -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- Footer Start -->
    <?php include('..\TheZone\footer.php') ?>
    <!-- Footer End -->

</body>
<html>