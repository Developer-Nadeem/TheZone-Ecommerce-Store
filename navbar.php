<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img class="img-fluid logo" src="images/logo-tp.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: flex; justify-content: space-between; align-items: center; width:100%;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacts.php">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="products-men.php">Mens</a></li>
                            <li><a class="dropdown-item" href="products-women.php">Womens</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="products-tshirt.php">T-Shirts</a></li>
                            <li><a class="dropdown-item" href="products-hoodie.php">Hoodies</a></li>
                            <li><a class="dropdown-item" href="products-jumper.php">Jumpers</a></li>
                            <li><a class="dropdown-item" href="products-jean.php">Jeans</a></li>
                            <li><a class="dropdown-item" href="products-trainer.php">Trainers</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['email']) && $_SESSION['isAdmin'] == 1){
                            echo '<a class="nav-link" href="adminhomepage.php">Go to Admin Home</a>';
                        }
                        ?>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="search_products.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data" autocomplete="off">
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['email'])) {
                            echo '<li><a href="logout.php" class="btn btn-outline-dark navbar-btn">Log Out<img src="images/logout-icon.png" alt="Logout" width="20" height="20"></a></li>';
                        } else {
                            echo '<li><a href="login-signup-page.php"class="btn btn-outline-dark">Login<img src="images/login-icon.png" alt="Login/Signup" width="20" height="20"></a></li>';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark shopping-cart-button" href="shopping-cart.php"><img src="images/shopping-cart-icon-nonhover.png" alt="Shopping Cart" width="20" height="20"></a>
                    </li>
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo ' <li class="nav-item">
                        <a class="btn btn-outline-dark shopping-cart-button" href="user-page.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                      </svg></a>
                       
                    </li>';
                    } ?>
                </ul>

            </div>
        </div>
    </nav>
</header>