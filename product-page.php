<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link rel="stylesheet" href="../TheZone/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <?php include('../TheZone/navbar.php') ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-6"><img class="img-fluid product-img" src="../TheZone/images/mens.jpg" alt="product-image"></div>
      <div class="col-6 product-desc">
        <h3>Product Title</h3>
        <p class="stars">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
        </p>
        <p class="price"><strong>£49.99</strong></p>
        <p class="desc">Elevate your style with this classic hoodie, featuring a comfortable fit <br>and timeless design for everyday casual wear.</p>
        <br>
        <p>Size:</p>
        <div class="sizes">
        <Span><a href="#">XS</a></Span>
        <Span><a href="#">S </a></Span>
        <Span><a href="#">M </a></Span>
        <Span><a href="#">L </a></Span>
        <Span><a href="#">XL</a></Span>
        </div>
        <p >Quantity:</p>
        <form action="#">
          <input class="Quantity" type="number" name="" id="" placeholder="1">
        </form>
        <div class="product-btns">
        <span><button type="button" class="btn btn-outline-dark add-toCart">Add to Cart</button></span>
        <span><button type="button" class="btn btn-outline-dark Buy-Now">Buy Now</button></span>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container-fluid reviews">
    <h2>Reviews:</h2>
    <div class="row">
      <div class="col review">
        <p><Strong>Review 1:</Strong></p>
        <p>Specatcular Item</p>
      </div>
      <div class="col review">
        <p><Strong>Review 2:</Strong></p>
        <p>Specatcular Item</p>
      </div>
      <div class="col review">
        <p><Strong>Review 3:</Strong></p>
        <p>Specatcular Item</p>
      </div>
    </div>
    
  </div>














  <?php include('../TheZone/footer.php')  ?>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>