<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Same head for a consistent format -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo 'Results for '. $_GET['search_data']; ?></title>
  <link rel="stylesheet" href="..\TheZone\style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!-- navbar start -->
  <?php include("navbar.php"); ?>
  <!-- navbar end -->
  <?php

  require("connectiondb.php");

  if (isset($_GET['search_data_products'])) {
    $search_data_value = $_GET['search_data'];

    $stmt = $db->query("SELECT * FROM inventory WHERE ProductName LIKE '%$search_data_value%'");
    $numOfRows = $stmt->rowCount() == 0;
    if ($numOfRows) {
      echo '<h2 class = "text-center text-danger">No results match your search</h2>';
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3"">';
      echo '<div class="card" style="width: 18rem">';
      echo '<img src="..\TheZone\images\\' . $row['ImageUrl'] . '" class="card-img-top" alt="' . $row['ProductName'] . '">';
      echo '<div class="card-body">';
      echo '<p class="card-text">' . $row['ProductName'] . '</p>';
      echo '<p class="card-text"><Strong>£' . $row['Price'] . '</Strong></p>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
  }
  ?>
  <!-- footer start -->
  <?php include("footer.php"); ?>
  <!-- footer ends -->




</body>

</html>