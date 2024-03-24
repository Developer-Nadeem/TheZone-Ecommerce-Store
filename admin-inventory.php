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
        .normal-stock {
            color: black;
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
                    <th style="display: hidden;">CategoryID</th>
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

                    $sizeQuantities = $db->query("SELECT * FROM stock_table INNER JOIN sizes_table on stock_table.SizeID = sizes_table.SizeID WHERE ProductID = " . $product['ProductID']);
                    $sizeQuantities = $sizeQuantities->fetchAll(PDO::FETCH_ASSOC);



                    echo "<tr>";
                    echo "<td >" . "<img style='width: 50px; height=50px' src=" . $product['ImageURL'] . " alt='product-img'>" .  "</td>";
                    echo "<td style='width: 150px;'>" . $product['ProductName'] . "</td>";
                    echo "<td>" . $product['ProductDescription'] . "</td>";
                    echo "<td>£" . $product['Price'] . "</td>";

                    echo "<td><p class=normal-stock>";
                    foreach ($sizeQuantities as $sizeQuantity) {
                        if ($product['CategoryID'] == 4) {
                            echo "Size" . $sizeQuantity['SizeName'] . ": " . $sizeQuantity['Quantity'] . " <br>";
                        } else {
                            echo $sizeQuantity['SizeName'] . ": " . $sizeQuantity['Quantity'] . "<br>";
                        }
                    }


                    "</p> </td>";

                    echo "<td style='display:none;'>" . $product['ProductID'] . "</td>";
                    echo "<td>" . $product['CategoryID'] . "</td>";
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
                        <!--size quantities-->
                        <div class="clothingSizesEdit" style="display: none;">
                            <div class="form-group">
                                <label for="QuantityXS" class="col-form-label">QuantityXS</label>
                                <input required type="text" name="QuantityXS" class="form-control" value="0" id="QuantityXS"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityS" class="col-form-label">QuantityS</label>
                                <input required type="text" name="QuantityS" class="form-control" value="0" id="QuantityS"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityM" class="col-form-label">QuantityM</label>
                                <input required type="text" name="QuantityM" class="form-control" value="0" id="QuantityM"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityL" class="col-form-label">QuantityL</label>
                                <input required type="text" name="QuantityL" class="form-control" value="0" id="QuantityL"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityXL" class="col-form-label">QuantityXL</label>
                                <input required type="text" name="QuantityXL" class="form-control" value="0" id="QuantityXL"><br>
                            </div>

                        </div>

                        <div class="ShoeSizesEdit" style="display: none;">
                            <div class="form-group">
                                <label for="QuantityA" class="col-form-label">Size 0:</label>
                                <input required type="text" name="QuantityA" class="form-control" value="0" id="QuantityA"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityB" class="col-form-label">Size 0.5: </label>
                                <input required type="text" name="QuantityB" class="form-control" value="0" id="QuantityB"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityC" class="col-form-label">Size 1:</label>
                                <input required type="text" name="QuantityC" class="form-control" value="0" id="QuantityC"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityD" class="col-form-label">Size 1.5:</label>
                                <input required type="text" name="QuantityD" class="form-control" value="0" id="QuantityD"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityE" class="col-form-label">Size 2:</label>
                                <input required type="text" name="QuantityE" class="form-control" value="0" id="QuantityE"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityF" class="col-form-label">Size 2.5:</label>
                                <input required type="text" name="QuantityF" class="form-control" value="0" id="QuantityF"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityG" class="col-form-label">Size 3:</label>
                                <input required type="text" name="QuantityG" class="form-control" value="0" id="QuantityG"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityH" class="col-form-label">Size 3.5:</label>
                                <input required type="text" name="QuantityH" class="form-control" value="0" id="QuantityH"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityI" class="col-form-label">Size 4:</label>
                                <input required type="text" name="QuantityI" class="form-control" value="0" id="QuantityI"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityJ" class="col-form-label">Size 4.5:</label>
                                <input required type="text" name="QuantityJ" class="form-control" value="0" id="QuantityJ"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityK" class="col-form-label">Size 5:</label>
                                <input required type="text" name="QuantityK" class="form-control" value="0" id="QuantityK"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityKK" class="col-form-label">Size 5:</label>
                                <input required type="text" name="QuantityKK" class="form-control" value="0" id="QuantityKK"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityL-shoe" class="col-form-label">Size 6:</label>
                                <input required type="text" name="QuantityL-shoe" class="form-control" value="0" id="QuantityL-shoe"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityM-shoe" class="col-form-label">Size 6.5:</label>
                                <input required type="text" name="QuantityM-shoe" class="form-control" value="0" id="QuantityM-shoe"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityN" class="col-form-label">Size 7:</label>
                                <input required type="text" name="QuantityN" class="form-control" value="0" id="QuantityN"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityO" class="col-form-label">Size 7.5:</label>
                                <input required type="text" name="QuantityO" class="form-control" value="0" id="QuantityO"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityP" class="col-form-label">Size 8:</label>
                                <input required type="text" name="QuantityP" class="form-control" value="0" id="QuantityP"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityQ" class="col-form-label">Size 8.5:</label>
                                <input required type="text" name="QuantityQ" class="form-control" value="0" id="QuantityQ"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityR" class="col-form-label">Size 9:</label>
                                <input required type="text" name="QuantityR" class="form-control" value="0" id="QuantityR"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityS-shoe" class="col-form-label">Size 9.5:</label>
                                <input required type="text" name="QuantityS-shoe" class="form-control" value="0" id="QuantityS-shoe"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityT" class="col-form-label">Size 10:</label>
                                <input required type="text" name="QuantityT" class="form-control" value="0" id="QuantityT"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityU" class="col-form-label">Size 10.5:</label>
                                <input required type="text" name="QuantityU" class="form-control" value="0" id="QuantityU"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityV" class="col-form-label">Size 11:</label>
                                <input required type="text" name="QuantityV" class="form-control" value="0" id="QuantityV"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityW" class="col-form-label">Size 11.5:</label>
                                <input required type="text" name="QuantityW" class="form-control" value="0" id="QuantityW"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityX" class="col-form-label">Size 12:</label>
                                <input required type="text" name="QuantityX" class="form-control" value="0" id="QuantityX"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityY" class="col-form-label">Size 12.5:</label>
                                <input required type="text" name="QuantityY" class="form-control" value="0" id="QuantityY"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityZ" class="col-form-label">Size 13:</label>
                                <input required type="text" name="QuantityZ" class="form-control" value="0" id="QuantityZ"><br>
                            </div>

                        </div>
                        <div class="form-group">

                            <input required type="hidden" name="EditCatID" class="form-control" id="EditCatID" placeholder="Enter Category ID"><br>
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
                            <label for="CatID" class="col-form-label">CategoryID</label>
                            <input required type="text" name="AddCatID" class="form-control" id="AddCatID" placeholder="Enter Category ID"><br>
                        </div>

                        <div class="clothingSizes" style="display: none;">
                            <div class="form-group">
                                <label for="QuantityXS" class="col-form-label">QuantityXS</label>
                                <input required type="text" name="QuantityXS" class="form-control" value="0" id="QuantityXS"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityS" class="col-form-label">QuantityS</label>
                                <input required type="text" name="QuantityS" class="form-control" value="0" id="QuantityS"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityM" class="col-form-label">QuantityM</label>
                                <input required type="text" name="QuantityM" class="form-control" value="0" id="QuantityM"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityL" class="col-form-label">QuantityL</label>
                                <input required type="text" name="QuantityL" class="form-control" value="0" id="QuantityL"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityXL" class="col-form-label">QuantityXL</label>
                                <input required type="text" name="QuantityXL" class="form-control" value="0" id="QuantityXL"><br>
                            </div>

                        </div>

                        <div class="ShoeSizes" style="display: none;">
                            <div class="form-group">
                                <label for="QuantityA" class="col-form-label">Size 0:</label>
                                <input required type="text" name="QuantityA" class="form-control" value="0" id="QuantityA"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityB" class="col-form-label">Size 0.5: </label>
                                <input required type="text" name="QuantityB" class="form-control" value="0" id="QuantityB"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityC" class="col-form-label">Size 1:</label>
                                <input required type="text" name="QuantityC" class="form-control" value="0" id="QuantityC"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityD" class="col-form-label">Size 1.5:</label>
                                <input required type="text" name="QuantityD" class="form-control" value="0" id="QuantityD"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityE" class="col-form-label">Size 2:</label>
                                <input required type="text" name="QuantityE" class="form-control" value="0" id="QuantityE"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityF" class="col-form-label">Size 2.5:</label>
                                <input required type="text" name="QuantityF" class="form-control" value="0" id="QuantityF"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityG" class="col-form-label">Size 3:</label>
                                <input required type="text" name="QuantityG" class="form-control" value="0" id="QuantityG"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityH" class="col-form-label">Size 3.5:</label>
                                <input required type="text" name="QuantityH" class="form-control" value="0" id="QuantityH"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityI" class="col-form-label">Size 4:</label>
                                <input required type="text" name="QuantityI" class="form-control" value="0" id="QuantityI"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityJ" class="col-form-label">Size 4.5:</label>
                                <input required type="text" name="QuantityJ" class="form-control" value="0" id="QuantityJ"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityK" class="col-form-label">Size 5:</label>
                                <input required type="text" name="QuantityK" class="form-control" value="0" id="QuantityK"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityKK" class="col-form-label">Size 5:</label>
                                <input required type="text" name="QuantityKK" class="form-control" value="0" id="QuantityKK"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityL-shoe" class="col-form-label">Size 6:</label>
                                <input required type="text" name="QuantityL-shoe" class="form-control" value="0" id="QuantityL-shoe"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityM-shoe" class="col-form-label">Size 6.5:</label>
                                <input required type="text" name="QuantityM-shoe" class="form-control" value="0" id="QuantityM-shoe"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityN" class="col-form-label">Size 7:</label>
                                <input required type="text" name="QuantityN" class="form-control" value="0" id="QuantityN"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityO" class="col-form-label">Size 7.5:</label>
                                <input required type="text" name="QuantityO" class="form-control" value="0" id="QuantityO"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityP" class="col-form-label">Size 8:</label>
                                <input required type="text" name="QuantityP" class="form-control" value="0" id="QuantityP"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityQ" class="col-form-label">Size 8.5:</label>
                                <input required type="text" name="QuantityQ" class="form-control" value="0" id="QuantityQ"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityR" class="col-form-label">Size 9:</label>
                                <input required type="text" name="QuantityR" class="form-control" value="0" id="QuantityR"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityS-shoe" class="col-form-label">Size 9.5:</label>
                                <input required type="text" name="QuantityS-shoe" class="form-control" value="0" id="QuantityS-shoe"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityT" class="col-form-label">Size 10:</label>
                                <input required type="text" name="QuantityT" class="form-control" value="0" id="QuantityT"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityU" class="col-form-label">Size 10.5:</label>
                                <input required type="text" name="QuantityU" class="form-control" value="0" id="QuantityU"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityV" class="col-form-label">Size 11:</label>
                                <input required type="text" name="QuantityV" class="form-control" value="0" id="QuantityV"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityW" class="col-form-label">Size 11.5:</label>
                                <input required type="text" name="QuantityW" class="form-control" value="0" id="QuantityW"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityX" class="col-form-label">Size 12:</label>
                                <input required type="text" name="QuantityX" class="form-control" value="0" id="QuantityX"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityY" class="col-form-label">Size 12.5:</label>
                                <input required type="text" name="QuantityY" class="form-control" value="0" id="QuantityY"><br>
                            </div>
                            <div class="form-group">
                                <label for="QuantityZ" class="col-form-label">Size 13:</label>
                                <input required type="text" name="QuantityZ" class="form-control" value="0" id="QuantityZ"><br>
                            </div>



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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.editbtn').on('click', function() {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                let data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);
                const pattern = /\d+/g;
                const numbers = data[4].match(pattern);

                if (data[6] == 4) {
                    document.querySelector('.ShoeSizesEdit').style.display = 'block';
                    document.querySelector('.clothingSizesEdit').style.display = 'none';

                    const regex = /Size(\d+(\.\d+)?): (\d+)/g;
                    const sizesArray = [];
                    let match;

                    while ((match = regex.exec(data[4])) !== null) {
                        const size = parseFloat(match[1]);
                        const value = parseInt(match[3]);
                        sizesArray.push({
                            size,
                            value
                        });
                    };

                    

                    let ids = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'KK', 'L-shoe', 'M-shoe', 'N', 'O', 'P', 'Q', 'R', 'S-shoe', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

                    for (let i = 0; i < ids.length; i++) {
                        if (i < sizesArray.length) {
                            $('#Quantity' + ids[i]).val(sizesArray[i].value);
                        }
                    }



                    /*                     $('#QuantityA').val(values[0]);
                                        $('#QuantityB').val(values[1]);
                                        $('#QuantityC').val(values[2]);
                                        $('#QuantityD').val(values[3]);
                                        $('#QuantityE').val(values[4]);
                                        $('#QuantityF').val(values[5]);
                                        $('#QuantityG').val(values[6]);
                                        $('#QuantityH').val(values[7]);
                                        $('#QuantityI').val(values[8]);
                                        $('#QuantityJ').val(values[10]);
                                        $('#QuantityK').val(values[11]);
                                        $('#QuantityKK').val(values[12]);
                                        $('#QuantityL-shoe').val(values[13]);
                                        $('#QuantityM-shoe').val(values[14]);
                                        $('#QuantityN').val(values[15]);
                                        $('#QuantityO').val(values[16]);
                                        $('#QuantityP').val(values[17]);
                                        $('#QuantityQ').val(values[18]);
                                        $('#QuantityR').val(values[19]);
                                        $('#QuantityS-shoe').val(values[20]);
                                        $('#QuantityT').val(values[21]);
                                        $('#QuantityU').val(values[22]);
                                        $('#QuantityV').val(values[23]);
                                        $('#QuantityW').val(values[24]);
                                        $('#QuantityX').val(values[25]);
                                        $('#QuantityY').val(values[26]);
                                        $('#QuantityZ').val(values[27]);
                     */




                } else {
                    document.querySelector('.clothingSizesEdit').style.display = 'block';
                    document.querySelector('.ShoeSizesEdit').style.display = 'none';
                    $('#QuantityXS').val(numbers[0]);
                    $('#QuantityS').val(numbers[1]);
                    $('#QuantityM').val(numbers[2]);
                    $('#QuantityL').val(numbers[3]);
                    $('#QuantityXL').val(numbers[4]);

                }

                $('#ProductName').val(data[1]);
                $('#Description').val(data[2]);
                $('#Price').val(data[3]);

                $('#ProductID').val(data[5]);
                $('#EditCatID').val(data[6]);

            })
        });

        $(document).ready(function() {
            $('.addnewbtn').on('click', function() {
                $('#newItem').modal('show');
            })
        })
    </script>

    <script>
        document.getElementById('AddCatID').addEventListener('input', function() {
            let catID = this.value;
            let clothingSizes = document.querySelector('.clothingSizes');
            let ShoeSizes = document.querySelector('.ShoeSizes');

            if (catID != 4) {
                clothingSizes.style.display = 'block';
                ShoeSizes.style.display = 'none';
            } else {
                clothingSizes.style.display = 'none';
                ShoeSizes.style.display = 'block';
            }


            
        });
    </script>


    <script>
        window.onload = function() {
            let urlParams = new URLSearchParams(window.location.search);
            let sortValue = urlParams.get('inv-dropdown');
            let filterValues = ['male', 'female', 'hoodie', 'jeans', 'jumper', 'trainer', 'tshirt'];

            if (sortValue) {
                document.querySelector("select[name='inv-dropdown']").value = sortValue;
            }

            filterValues.forEach(function(filter) {
                let filterValue = urlParams.get(filter);
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