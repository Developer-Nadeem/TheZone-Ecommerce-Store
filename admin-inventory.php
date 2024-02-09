<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheZone</title>
    <link rel="stylesheet" href="../TheZone/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Inventory page</title>
</head>

<body>
    <?php include('../TheZone/adminnavbar.php') ?>
    <main class="container">
        <!-- <div id="product-form">
            <h2>Add Product</h2>
            <form id="add-product">
                <label for="product-name">Name:</label>
                <input type="text" id="product-name" name="product-name" required><br><br>

                <label for="product-price">Price:</label>
                <input type="number" id="product-price" name="product-price" required><br><br>
                <label for="product-quantity">Quantity:</label>
                <input type="number" id="product-quantity" name="product-quantity" required><br><br>
                <button type="submit">Add Product</button>
            </form>
        </div> -->

        <div id="container" class="table-responsive">
            <table class="table-product-list">
                <thead>
                    <tr class="tr">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody id="product-list"></tbody>
            </table>
        </div>

        <style>
        .table-product-list {
            width: 100%;
            border-collapse: collapse;
        }

        .table-product-list th,
        .table-product-list td {
            padding: 20px;
            border: 1px solid #ccc;
        }

        .table-product-list th {
            background-color: #444;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        .table-product-list td {
            text-align: center;
        }

        .table-product-list tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-product-list tbody tr:hover {
            background-color: #ddd;
        }
        </style>

        <script>
        const dummyProducts = [{
                name: 'Product 1',
                price: 20,
                quantity: 50,

            },
            {
                name: 'Product 2',
                price: 30,
                quantity: 60,

            },
            {
                name: 'Product 3',
                price: 140,
                quantity: 40,

            },
            {
                name: 'Product 4',
                price: 58,
                quantity: 90,

            },
            {
                name: 'Product 5 ',
                price: 40,
                quantity: 30,

            }
        ];

        function displayProductList(products) {
            const productList = document.getElementById('product-list');
            productList.innerHTML = '';

            products.forEach((product, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${product.name}</td>
                        <td>${product.price}</td>
                        <td>${product.quantity}</td>
                        
                    `;
                productList.appendChild(row);
            });
        }

        displayProductList(dummyProducts);

        document.getElementById('add-product').addEventListener('submit', function(event) {
            event.preventDefault();

            const productName = document.getElementById('product-name').value;
            const productPrice = parseFloat(document.getElementById('product-price').value);
            const productQuantity = parseInt(document.getElementById('product-quantity').value);

            const newProduct = {
                name: productName,
                price: productPrice,
                quantity: productQuantity,

            };

            dummyProducts.push(newProduct);

            displayProductList(dummyProducts);

            document.getElementById('add-product').reset();
        });
        </script>

    </main>

</body>

</html>