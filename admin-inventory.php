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


        .inv-filter-container>div {
            padding: 0 10px;
            border-right: 3px solid #000;
        }

        .inv-filter-container>div:last-child {
            margin-right: -1px;
            border-right: 1px solid #ccc;
        }

        label {
            margin-right: 10px;
        }

        select,
        input[type="search"] {
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

        .low-stock {
            color: red;
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
    <!-- //pop up modal for editing item -->
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

    <!-- //pop up modal for adding item -->
    <div class="modal fade" id="newItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Item:</h5>
                    <button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="../TheZone/admin-inventory-add-item.php" method="post" class="custom-padding">
                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <label for="ProductName" class="col-form-label">Product Name</label>
                            <input required type="text" class="form-control" name="ProductName" id="ProductName" aria-describedby="ProductName" placeholder="ProductName">
                        </div>
                        <div class="form-group">
                            <label for="Description" class="col-form-label">Description</label><br>
                            <textarea required name="Description" class="form-control" id="Description" cols="61" rows="2" placeholder="Enter a product description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ImageURL" class="col-form-label">Image URL</label>
                            <input required type="text" class="form-control" name="ImageURL" id="ImageURL" aria-describedby="ImageURL" placeholder="ImageURL">
                        </div>
                        <div class="form-group">
                            <label for="Price" class="col-form-label">Price</label>
                            <input required type="text" name="Price" class="form-control" id="Price" placeholder="£">
                        </div>
                        <div class="form-group">
                            <label for="Quantity" class="col-form-label">Quantity</label>
                            <input required type="text" name="Quantity" class="form-control" id="Quantity" placeholder="Enter stock quantity"><br>
                        </div>
                        <div class="form-group">
                            <label for="CatID" class="col-form-label">CategoryID</label>
                            <input required type="text" name="CatID" class="form-control" id="CatID" placeholder="Enter Category ID"><br>
                        </div>
                        <div class="form-group">
                            <label for="GenderID" class="col-form-label">GenderID</label>
                            <input required type="text" name="GenderID" class="form-control" id="GenderID" placeholder="Enter Gender ID"><br>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="csrftoken" value="<?php echo $CSRFToken ?>"><br>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="submitted" id="submitted">
                        <button type="submit" name="updatedata" class="btn btn-secondary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- modal end -->

    <!-- Filter box -->
    <section class="inv-filter-container">
        <form id="filterForm" action="" method="get">
            <!-- Sort By Dropdown -->
            <div class="checkboxes">
                <label for="inv-dropdown">Sort By: </label>
                <select name="inv-dropdown">
                    <option value="default">None</option>
                    <option value="price-high">Price (High to Low)</option>
                    <option value="price-low">Price (Low to High)</option>
                    <option value="stock-high">Stock (High to Low)</option>
                    <option value="stock-low">Stock (Low to High)</option>
                </select>
            </div>

            <!-- Filter By checkboxes -->
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

                <button type="button" onclick="applyFilters()">Apply Filters</button>

            </div>
        </form>
    </section>
    <div class="addbtn"><button type='button' class='btn btn-primary addnewbtn'> + Add new </button></div>
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

                //checks to see if a sort filter has been selected, if not, it uses the default
                $sortOption = isset($_GET['inv-dropdown']) ? $_GET['inv-dropdown'] : 'default';

                switch ($sortOption) {
                    case 'price-high':
                        $orderBy = 'ORDER BY Price DESC';
                        break;
                    case 'price-low':
                        $orderBy = 'ORDER BY Price ASC';
                        break;
                    case 'stock-high':
                        $orderBy = 'ORDER BY StockQuantity DESC';
                        break;
                    case 'stock-low':
                        $orderBy = 'ORDER BY StockQuantity ASC';
                        break;
                    default:
                        $orderBy = '';
                        break;
                }

                // Stores all checked filtering options inside an array
                $filterBox = [];

                // Performs checks to see if the checkboxes have been selected
                if (isset($_GET['male'])) {
                    $filterBox[] = "GenderID = '1'";
                }

                if (isset($_GET['female'])) {
                    $filterBox[] = "GenderID = '2'";
                }

                if (isset($_GET['hoodie'])) {
                    $filterBox[] = "CategoryID = '3'";
                }

                if (isset($_GET['jeans'])) {
                    $filterBox[] = "CategoryID = '5'";
                }

                if (isset($_GET['jumper'])) {
                    $filterBox[] = "CategoryID = '2'";
                }

                if (isset($_GET['trainer'])) {
                    $filterBox[] = "CategoryID = '4'";
                }

                if (isset($_GET['tshirt'])) {
                    $filterBox[] = "CategoryID = '1'";
                }

                // Combine conditions using AND
                $filterOption = '';
                if (!empty($filterBox)) {
                    $filterOption = "WHERE " . implode(" OR ", $filterBox);
                }

                $inventory = $db->prepare("SELECT * FROM inventory $filterOption $orderBy");
                $inventory->execute();

                foreach ($inventory as $product) {
                    echo "<tr>";
                    echo "<td >" . "<img style='width: 50px; height=50px' src=" . $product['ImageURL'] . " alt='product-img'>" .  "</td>";
                    echo "<td style='width: 150px;'>" . $product['ProductName'] . "</td>";
                    echo "<td>" . $product['ProductDescription'] . "</td>";
                    echo "<td>£" . $product['Price'] . "</td>";
                    if ($product['StockQuantity'] < 20) {
                        echo "<td><p class=low-stock>" . $product['StockQuantity'] . "</p> </td>";
                    } else {
                        echo "<td>" . $product['StockQuantity'] . "</td>";
                    }
                    echo "<td style='display:none;'>" . $product['ProductID'] . "</td>";
                    echo "<td><button type='button' class='btn btn-primary editbtn'>EDIT</button>";

                    echo "<form class='binbtn' style='display: inline-block;' action='../TheZone/remove-product.php' method='post'>";
                    echo "<input type='hidden' name='removeProductID' value='" . $product['ProductID'] . "'>";
                    echo "<input type='hidden' name='productName' value='" . $product['ProductName'] . "'>";
                    echo "<button type='submit' class='btn btn-danger removeitembtn'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                    <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
                    <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
                  </svg></button>";
                    echo "</form>";
                    echo "</td>";
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

        $(document).ready(function() {
            $('.addnewbtn').on('click', function() {
                $('#newItem').modal('show');
            })
        })
    </script>


    <script>
        window.onload = function() {
            var urlParams = new URLSearchParams(window.location.search);
            var sortValue = urlParams.get('inv-dropdown');
            var filterValues = ['male', 'female', 'hoodie', 'jeans', 'jumper', 'trainer', 'tshirt'];

            if (sortValue) {
                document.querySelector("select[name='inv-dropdown']").value = sortValue;
            }

            filterValues.forEach(function(filter) {
                var filterValue = urlParams.get(filter);
                if (filterValue) {
                    document.querySelector("input[name='" + filter + "']").checked = true;
                }
            });
        };

        function applyFilters() {
            document.getElementById("filterForm").submit();
        }
    </script>


</body>

</html>