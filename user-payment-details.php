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
            <div class="row justify-content-center">
                <div class="col-12">
                    <a href="user-page.php" class="btn btn-primary">Back to User Page</a>
                    <h1 class="text-center">Your Account</h1>



                    <?php if (isset($paymentDetails) && !empty($paymentDetails)) : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Cardholder Name</th>
                                <th>Card Number</th>
                                <th>Expiry Date</th>
                                <th>CVV</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($paymentDetails as $paymentDetail) : ?>
                            <tr>
                                <td><?php echo $paymentDetail['PaymentID']; ?></td>
                                <td><?php echo $paymentDetail['CardholderName']; ?></td>
                                <td><?php echo $paymentDetail['CardNumber']; ?></td>
                                <td><?php echo $paymentDetail['ExpiryDate']; ?></td>
                                <td><?php echo $paymentDetail['CVV']; ?></td>
                                <td>

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editPaymentModal"
                                        data-paymentid="<?php echo $paymentDetail['PaymentID']; ?>"
                                        data-cardholdername="<?php echo $paymentDetail['CardholderName']; ?>"
                                        data-cardnumber="<?php echo $paymentDetail['CardNumber']; ?>"
                                        data-expirydate="<?php echo $paymentDetail['ExpiryDate']; ?>"
                                        data-cvv="<?php echo $paymentDetail['CVV']; ?>">Edit</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else : ?>
                    <p>No payment details found.</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </main>

    <!-- Add Payment Modal -->
    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPaymentModalLabel">Add Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding payment details -->
                    <form action="add-payment-details.php" method="POST">
                        <div class="mb-3">
                            <label for="cardholderName" class="form-label">Cardholder Name</label>
                            <input type="text" class="form-control" id="cardholderName" name="cardholderName" required>
                        </div>
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="expiryDate" class="form-label">Expiry Date</label>
                            <input type="text" class="form-control" id="expiryDate" name="expiryDate" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Payment Details</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Payment Modal -->
    <div class="modal fade" id="editPaymentModal" tabindex="-1" aria-labelledby="editPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPaymentModalLabel">Edit Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing payment details -->
                    <form action="update-payment-details.php" method="POST">
                        <div class="mb-3">
                            <label for="editCardholderName" class="form-label">Cardholder Name</label>
                            <input type="text" class="form-control" id="editCardholderName" name="editCardholderName"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editCardNumber" class="form-label">Card Number</label>
                            <input type="text" class="form-control" id="editCardNumber" name="editCardNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="editExpiryDate" class="form-label">Expiry Date</label>
                            <input type="text" class="form-control" id="editExpiryDate" name="editExpiryDate" required>
                        </div>
                        <input type="hidden" id="editPaymentID" name="editPaymentID">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php include('footer.php') ?>
    <!-- Footer End -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-wNclOarT2rwK2M+XCYf1zWPyjHwWe5bs4AWt4Thos2YR+cR1XtlKStn1YFnTk3lu" crossorigin="anonymous">
    </script>


    <script>
    var editModal = document.getElementById('editPaymentModal');
    editModal.addEventListener('show.bs.modal', function(event) {

        var button = event.relatedTarget;

        var paymentID = button.getAttribute('data-paymentid');
        var cardholderName = button.getAttribute('data-cardholdername');
        var cardNumber = button.getAttribute('data-cardnumber');
        var expiryDate = button.getAttribute('data-expirydate');
        var cvv = button.getAttribute('data-cvv');

        editModal.querySelector('#editPaymentID').value = paymentID;
        editModal.querySelector('#editCardholderName').value = cardholderName;
        editModal.querySelector('#editCardNumber').value = cardNumber;
        editModal.querySelector('#editExpiryDate').value = expiryDate;
    })
    </script>
</body>

</html>