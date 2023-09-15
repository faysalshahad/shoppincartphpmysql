<!--Connecting to the phpMyAdmin Database -->
<?php
include "connectphp.php";

//update Query
if (isset($_POST['updateQuantityButton'])) {
    # code...
    $updateQuantity = $_POST['updateQuantityIn'];
    $IDtoUpdateQuantity = $_POST['updateIDIn'];

    $sqlUpdateQuery = "update cart set 
    quantity = $updateQuantity
    where id = $IDtoUpdateQuantity";

    $updateResult = mysqli_query($connectphp, $sqlUpdateQuery);

    if ($updateResult) {

        # method to collect and store the image path inside the database
        #move_uploaded_file($imageItemTMPD, $imageItemFolderD);
                   
        # code...
        echo '<script>alert("Data has been updated in table named goods successfully")</script>';
        #header("location:displayitem.php");    
    
    } else {
            # code...
        echo ("There is an error to connect to the database. 
        Please check your internet, connection or codes.");
        die(mysqli_error());
           
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Item</title>

<!-- Bootstrap CSS CDN-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">



</head>
<body style="background:#C3EDC0">

<!--Linking Header File -->
<?php
include "./partials/header.html";
?>


<div class="container my-3">
<hr>
<section>
<h3 class="text-center mb-3 text-danger">Your Items</h3>

<!-- <a href="user.php" class="btn btn-outline-primary btn-lg" style="margin-top: .5rem;">Add New User</a> -->
</div>
<div class="container my-2">
<table class="table table-danger">
  <thead>
    <tr class="table-warning">
      <th scope="col">ID No.</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Image</th>
      <th scope="col">Total Price</th>
      <th scope="col">Action</th>
      
      <!-- <th scope="col">Phone</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th> -->
       
    </tr>
  </thead>
  <tbody>
  <?php
    # code to display the content in the website from the database
    $sqldisplayinfo = "select * from cart";
    $resultdisplay = mysqli_query($connectphp,$sqldisplayinfo);
    $grandTotal = 0;
    if (mysqli_num_rows($resultdisplay)>0) {
        # code...
        while ($rowtable = mysqli_fetch_assoc($resultdisplay)) {

            # code...
            #IDt is the table column name
            $IDDisplay = $rowtable ['id'];
            #namet is the table column name
            $nameDisplay =  $rowtable ['name'];
            #detailst is the table column name
            $quantityDisplay =  $rowtable ['quantity'];
            #pricet is the table column name
            $priceDisplay = $rowtable ['price'];
            #imaget is the table column name
            $imagedisplay = $rowtable ['image'];
            #Calculating the total price
            $totalPrice = $priceDisplay * $quantityDisplay;
           ?>

            <tr class="table-warning">
            <th scope="row"><?php echo $IDDisplay ?></th>
            <td><?php echo $nameDisplay ?></td>
            <td>$<?php echo $priceDisplay ?> /= USD</td>
            <td>
                <form action="" method="post">
                <div class="quantity_box">
                    <input type="hidden" name="updateIDIn" value="<?php echo $IDDisplay ?>">
                    <input type="number" min="1" max="1000" name="updateQuantityIn" value="<?php echo $quantityDisplay ?>">
                    <button type="submit" class="btn btn-outline-dark" name="updateQuantityButton">Update</button>
                </div>
                </form>
                </td>
            
            <td>
                <img src="image/<?php echo $imagedisplay;?>" alt="<?php echo $nameDisplay?>" width="100" height="100"> 
            </td>
            <td>
            $<?php echo $totalPrice ?> /= USD       
            </td>
            <td>
                <a href="deletecart.php?deleteID=<?php echo $IDDisplay ?>" class="btn btn-outline-danger" style="margin-top: .5rem;"
            onclick="return confirm('Would You like to delete the product from your basket?');">Delete</a>

        </td>
            
          </tr>

      <?php
      $grandTotal += $totalPrice;
    }
} else {
    # code...
    
    echo ("<div class='container my-5'>Your shopping cart is empty.</div>");
    
}
    ?>

  </tbody>
</table>

<?php

?>

<!--Bottom Area-->
<div class="container mt-3">
<h3>Grand Total: $<?php echo $grandTotal ?> /= USD</h3>
<a href="payment.php" class="btn btn-outline-success btn-lg" style="margin-top: .5rem; margin-right: 6rem;">Confirm Purchase</a>
<a href="buyproducts.php" class="btn btn-outline-primary btn-lg" style="margin-top: .5rem; margin-right: 8rem;">Continue Shopping</a>
<a href="deleteallcart.php?deleteAllID" class="btn btn-outline-danger btn-lg" style="margin-top: .5rem;"
onclick="return confirm('Would You like to delete all the products from your basket?');">Empty Basket</a>
<!-- <button type="submit" class="btn btn-outline-danger btn-lg" name="emptyCartButton" style="margin-top: .5rem;">Empty Basket</button> -->
</div>
</div>
<!--Linking Footer File -->
<?php
include "./partials/footer.html";
?>
    
<!--Linking JavaScript File -->
<script src="javascript/script.js"></script>
</section>
</div>
</body>
</html>