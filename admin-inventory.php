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
    <style>
        .modal-body {
            padding: 25px;
            margin: 25px;
        }

        .modal-title {
            padding: 10px;
        }

        .form-group {
            width: 100%;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
        }

        .custom-padding .modal-body {
            padding: 50px;
            /* Adjust the value as needed */
        }

        .main-form {
            padding: 30px;
        }

        .btn-secondary {
            margin: 5px;
        }

        .inventory-search {
            margin: 10px;
        }

        /* Filter Section Styling */
        .inv-filter-container {
            flex: 1;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            margin: 10px;
            text-align: center;
        }

        
        .inv-filter-container > div {
            padding: 0 10px; 
            border-right: 3px solid #000; 
        }

        .inv-filter-container > div:last-child {
            margin-right: -1px;
            border-right: 1px solid #ccc;
        }

        label {
            margin-right: 10px;
        }

        select, input[type="search"] {
            padding: 8px;
            font-size: 14px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        .inventory-search {
            margin-top: 10px;
        }

        .inv-dropdown {
            margin-right: 5px;
        }

        /* Optional: Add some styling for better visibility of the search input */
        .inventory-search input[type="search"] {
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .checkboxes {
            padding: 5px;
        }
        .low-stock{
            color:red;
            font-weight: bold;
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>
    <?php
    if (!isset($_SESSION['CSRF_Token'])) {
        $_SESSION['CSRF_Token'] = bin2hex(random_bytes(32));
    }
    $CSRFToken = $_SESSION['CSRF_Token'];

    include("../TheZone/adminnavbar.php");

    ?>
    <!-- //pop up modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Inventory:</h5>
                    <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               
                    <form action="../TheZone/Inventory-update-code.php" method="post" class="custom-padding">
                        <div class="modal-body">

                            <input type="hidden" name="update_id" id="update_id">
                            <div class="form-group">
                                <label for="ProductID" class="col-form-label">Product ID</label>
                                <input type="text" name="ProductID" class="form-control" id="ProductID" style="pointer-events:none;">

                            </div>
                            <div class="form-group">
                                <label for="ProductName" class="col-form-label">Product Name</label>
                                <input required type="text" class="form-control" name="ProductName" id="ProductName" aria-describedby="ProductName" placeholder="ProductName">
                            </div>
                            <div class="form-group">
                                <label for="Description" class="col-form-label">Description</label><br>
                                <textarea required name="Description" class="form-control" id="Description" cols="61" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Price" class="col-form-label">Price</label>
                                <input required type="text" name="Price" class="form-control" id="Price">
                            </div>
                            <div class="form-group">
                                <label for="Quantity" class="col-form-label">Quantity</label>
                                <input required type="text" name="Quantity" class="form-control" id="Quantity"><br>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="csrftoken" value="<?php echo $CSRFToken ?>"><br>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="hidden" name="submitted" id="submitted">
                            <button type="submit" name="updatedata" class="btn btn-secondary">Update Inventory</button>
                        </div>
                    </form>
             
            </div>
        </div>
    </div>
    <!-- modal end -->

    <!-- Filter box -->
    <section class="inv-filter-container">
        <div class="checkboxes">
            <label for="inv-dropdown">Sort By: </label>
            <select name="inv-dropdown">
                <option value="default">None</option>
                <option value="price-high">Price: High to Low</option>
                <option value="price-low">Price: Low to High</option>
                <option value="stock-high">Stock: Low to High</option>
                <option value="stock-low">Stock: High to Low</option>
            </select>
        </div>

        <div>
            <label>Filter By: </label>

            <label for="male">Male:</label>
            <input type="checkbox" id="male" name="male" value="Male">

            <label for="female">Female:</label>
            <input type="checkbox" id="female" name="female" value="Female">

            <label for="hoodie">Hoodie:</label>
            <input type="checkbox" id="hoodie" name="hoodie" value="Hoodie">

            <label for="jeans">Jeans:</label>
            <input type="checkbox" id="jeans" name="jeans" value="Jeans">

            <label for="jumper">Jumper:</label>
            <input type="checkbox" id="jumper" name="jumper" value="Jumper">

            <label for="trainer">Trainer:</label>
            <input type="checkbox" id="trainer" name="trainer" value="Trainer">

            <label for="tshirt">T-Shirt:</label>
            <input type="checkbox" id="tshirt" name="tshirt" value="Tshirt">
        </div>

        <div>
            <form role="search" action="#" method="get" class="inventory-search">
                <label>Find Product: </label>
                <input type="search" class="" placeholder="Search" aria-label="Search" name="inv-search_data" autocomplete="off">
            </form>
        </div>

    </section>

 <!-- //table content -->
    <section class="hero">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../TheZone/connectiondb.php');

                $inventory = $db->prepare("SELECT * FROM Inventory");
                $inventory->execute();

                foreach ($inventory as $product) {
                    echo "<tr>";
                    echo "<td >" . "<img style='width: 50px; height=50px' src=" . $product['ImageURL'] . " alt='product-img'>" .  "</td>";
                    echo "<td style='width: 150px;'>" . $product['ProductName'] . "</td>";
                    echo "<td>" . $product['ProductDescription'] . "</td>";
                    echo "<td>£" . $product['Price'] . "</td>";
                    if($product['StockQuantity']<20){
                    echo "<td><p class=low-stock>" . $product['StockQuantity'] ."</p> </td>";
                    }else{
                    echo "<td>" . $product['StockQuantity'] . "</td>";
                    }
                    echo "<td style='display:none;'>" . $product['ProductID'] . "</td>";
                    echo "<td><button type='button' class='btn btn-primary editbtn'>EDIT</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.editbtn').on('click', function() {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                

                $('#ProductName').val(data[1]);
                $('#Description').val(data[2]);
                $('#Price').val(data[3]);
                $('#Quantity').val(data[4]);
                $('#ProductID').val(data[5]);

            })
        });
    </script>

</body>

</html>