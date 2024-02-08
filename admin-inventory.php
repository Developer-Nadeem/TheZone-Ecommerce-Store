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
        <div id="chart-container">
            <canvas id="myChart" width="400" height=" 200"></canvas>
        </div>

        <div id="container">

            <div class="product-list">

            </div>
        </div>
        <style>
        .container {

            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        #chart-container {
            flex: 1;
            margin-right: 20px;

        }

        .product-list {

            flex: 1;
        }

        .product-list {

            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 50px;

        }

        .product {
            border: 5px solid #ccc;
            padding: 20px;
            text-align: center;

        }

        .product img {

            max-width: 100%;
            height: auto;
        }
        </style>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        const dummyProducts = [{
                name: 'Product 1',
                imageUrl: 'images/beautiful-smiling-model-with-horns-hairstyle-dressed-summer-hipster-jacket-jeans-clothes-sexy-carefree-girl-posing-street-trendy-funny-positive-woman-having-fun-sunglasses.jpg',
                price: 20,
                quantity: 50,
                sales: {
                    today: 50,
                    thisMonth: 90,
                    thisYear: 200
                }
            },
            {
                name: 'Product 2',
                imageUrl: 'images/beautiful-smiling-model-with-horns-hairstyle-dressed-summer-hipster-jacket-jeans-clothes-sexy-carefree-girl-posing-street-trendy-funny-positive-woman-having-fun-sunglasses.jpg',
                price: 30,
                quantity: 60,
                sales: {
                    today: 50,
                    thisMonth: 90,
                    thisYear: 250
                }
            },
            {
                name: 'Product 3',
                imageUrl: 'images/young-couple-wearing-trucker-hat.jpg',
                price: 140,
                quantity: 40,
                sales: {
                    today: 70,
                    thisMonth: 90,
                    thisYear: 500
                }
            },
            {
                name: 'Product 4',
                imageUrl: 'images/fashion-model-with-beautiful-face-perfect-body-wearing-trendy-dress-holding-brown-leather-hand-bag-full-length.jpg',
                price: 58,
                quantity: 90,
                sales: {
                    today: 60,
                    thisMonth: 90,
                    thisYear: 200
                }
            },
            {
                name: 'Product 5 ',
                imageUrl: 'images/fashion-model-with-beautiful-face-perfect-body-wearing-trendy-dress-holding-brown-leather-hand-bag-full-length.jpg',
                price: 170,
                quantity: 30,
                sales: {
                    today: 70,
                    thisMonth: 95,
                    thisYear: 300
                }
            }

        ];



        function displayProductList(products) {
            const productListDiv = document.querySelector('.product-list');

            products.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('product');

                const image = document.createElement('img');
                image.src = product.imageUrl;
                image.alt = product.name;
                productDiv.appendChild(image);

                const name = document.createElement('p');
                name.textContent = `Name: ${product.name}`;
                productDiv.appendChild(name);

                const price = document.createElement('p');
                price.textContent = `Price: £${product.price}`;
                productDiv.appendChild(price);

                const stockQuantity = document.createElement('p');
                stockQuantity.textContent = `Stock Quantity: ${product.quantity}`;
                productDiv.appendChild(stockQuantity);

                const todaySales = document.createElement('p');
                todaySales.textContent = `Today's sales: ${product.sales.today}`;
                productDiv.appendChild(todaySales);

                const thisMonthSales = document.createElement('p');
                thisMonthSales.textContent = `This Month's sales: ${product.sales.thisMonth}`;
                productDiv.appendChild(thisMonthSales);

                const thisYearSales = document.createElement('p');
                thisYearSales.textContent = `This Year's sales: ${product.sales.thisYear}`;
                productDiv.appendChild(thisYearSales);

                productListDiv.appendChild(productDiv);
            });
        }

        displayProductList(dummyProducts);

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dummyProducts.map(product => product.name),
                datasets: [{
                        label: 'Today\'s Sales',
                        data: dummyProducts.map(product => product.sales.today),
                        backgroundColor: 'rgba(9, 122, 62, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 5
                    },
                    {
                        label: 'This Month\'s Sales',
                        data: dummyProducts.map(product => product.sales.thisMonth),
                        backgroundColor: 'rgba(249, 48, 188, 0.8)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 5
                    },
                    {
                        label: 'This Year\'s Sales',
                        data: dummyProducts.map(product => product.sales.thisYear),
                        backgroundColor: 'rgba(156, 166, 223, 0.8)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 5
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        </script>

    </main>

</body>

</html>