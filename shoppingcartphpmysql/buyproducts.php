<!--Connecting to the phpMyAdmin Database -->
<?php
include "connectphp.php";

if (isset($_POST['addItemButton'])) {
    # code...
    $productNameBuy = $_POST['product_name'];
    $productPriceBuy = $_POST['product_price'];
    $productImageBuy = $_POST['product_image'];
    $productQuantity = 1;

    $sqlInsert = "insert into cart
    (name, price, image, quantity) 
    values ('$productNameBuy', '$productPriceBuy', '$productImageBuy', $productQuantity)";


    //insert cart data in cart table
    $insertProductsToCart = mysqli_query($connectphp, $sqlInsert);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Item</title>

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
<section class="products">
<h3 class="text-center mb-3 text-danger"> Purchase Items</h3>

<!-- <div class="product_container text-center">
    <form action="" method="post">
    <div class="edit_form">
        <img src="image/iphone.jpg" alt="" width="150" height="200">
        <h4 class="mb-3 text-primary">Iphone</h4>
        <div class="price">Price: $12000</div>
        <input type="hidden" name="product_name">
        <input type="hidden" name="product_price">
        <input type="hidden" name="product_image">
        <button type="submit" class="btn btn-outline-success btn-lg" style="margin: 1rem;" name="addItemButton">Add Item</button>

    </div>
    </form>
</div> -->

<div class="container my-2">
    <!-- <form action="" method="post"> -->
<table class="table table-danger">
  <thead>
    <tr class="table-warning">
      <th scope="col">ID No.</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
      <!-- <th scope="col">Phone</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th> -->
       
    </tr>
  </thead>
  <tbody>
  <?php
    # code to display the content in the website from the database
    $sqldisplayinfo = "select * from goods";
    $resultdisplay = mysqli_query($connectphp, $sqldisplayinfo);
    if (mysqli_num_rows($resultdisplay)>0) {
        # code...
        while ($rowtable = mysqli_fetch_assoc($resultdisplay)) {

            # code...
            #IDt is the table column name
            $IDDisplay = $rowtable ['IDt'];
            #namet is the table column name
            $nameDisplay =  $rowtable ['namet'];
            #detailst is the table column name
            $detailsDisplay =  $rowtable ['detailst'];
            #pricet is the table column name
            $priceDisplay = $rowtable ['pricet'];
            #imaget is the table column name
            $imagedisplay = $rowtable ['imaget'];
           ?>

            <tr class="table-warning">
            <th scope="row"><?php echo $IDDisplay ?></th>
            <td><?php echo $nameDisplay ?></td>
            <td><?php echo $detailsDisplay ?>
           </td>
            <td><?php echo $priceDisplay ?> /= USD</td>            
            <td>
                <img src="image/<?php echo $imagedisplay;?>" alt="<?php echo $nameDisplay?>" width="100" height="100"> 
            </td>
            <td>
            <a href="addquantity.php?purchaseID=<?php echo $IDDisplay ?>" class="btn btn-outline-success " style="margin: .5rem;">Buy Item</a>

            </td>
          </tr>
          <!-- </form> -->
      <?php
    }
} else {
    # code...
    
    echo ("<div class='container my-5'>There is no product available at this moment. Sorry.</div>");
    
}
    ?>
   

  </tbody>
</table>
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