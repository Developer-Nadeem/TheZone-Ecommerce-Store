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
</head>

<body>
<?php
 session_start();
 if(!isset($_SESSION['CSRF_Token'])){
    $_SESSION['CSRF_Token'] = bin2hex(random_bytes(32));
  }
   $CSRFToken = $_SESSION['CSRF_Token'];

?>
<!-- //pop up modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Inventory:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../TheZone/Inventory-update-code.php" method="post" >
      <div class="modal-body">
                <input type="hidden" name="update_id" id="update_id">
                <div class="form-group">
                <label for="ProductID">Product ID</label><br>
                <input type="text" name="ProductID" class="form-control" id="ProductID" style="pointer-events:none;" ><br>
               
            </div>
            <div class="form-group">
                <label for="ProductName">Product Name</label>
                <input required type="text" class="form-control" name="ProductName" id="ProductName" aria-describedby="ProductName" placeholder="ProductName">
            </div>
            <div class="form-group">
                <label for="Description">Description</label><br>
               <textarea required name="Description" id="Description" cols="61" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="Price">Price</label>
                <input required type="text" name="Price" class="form-control" id="Price" >
            </div>
            <div class="form-group">
                <label for="Quantity">Quantity</label>
                <input required type="text" name="Quantity" class="form-control" id="Quantity" ><br>
            </div>
            
           
      </div>
      <div class="modal-footer">
            <input type="hidden" name="csrftoken" value="<?php echo $CSRFToken ?>"><br>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="hidden" name="submitted" id="submitted">
        <button type="submit" name = "updatedata" class="btn- btn-primary">Update Inventory</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- modal end -->



    <section class="hero">
   
        
        <!-- //table content -->
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
                include("../TheZone/adminnavbar.php");
                

                
                $inventory = $db->prepare("SELECT * FROM Inventory");
                $inventory->execute();
                

                foreach ($inventory as $product) {
                    echo "<tr>";
                    echo "<td >" . "<img style='width: 50px; height=50px' src=". $product['ImageURL']." alt='product-img'>".  "</td>";
                    echo "<td style='width: 150px;'>" . $product['ProductName'] . "</td>";
                    echo "<td>". $product['ProductDescription']. "</td>";
                    echo "<td>". $product['Price']. "</td>";
                    echo "<td>" . $product['StockQuantity'] . "</td>";
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
    $(document).ready(function(){ 
        $('.editbtn').on('click', function(){

            $('#editmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function (){
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



