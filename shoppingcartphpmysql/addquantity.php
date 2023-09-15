<!--Connecting to the phpMyAdmin Database -->
<?php
include "connectphp.php";

$idtoupdate = $_GET['purchaseID'];

$sqldisplayinfo = "select * from goods where IDt = $idtoupdate";
$resultdisplay = mysqli_query($connectphp,$sqldisplayinfo);
$rowtable = mysqli_fetch_assoc($resultdisplay);

#namet is the column name is sql database
$nameDisplay =  $rowtable ['namet'];
#detailst is the column name is sql database
$detailsDisplay =  $rowtable ['detailst'];
#pricet is the column name is sql database
$priceDisplay = $rowtable ['pricet'];
#imaget is the column name is sql database
$imageDisplay = $rowtable ['imaget'];


if (isset($_POST['addToCartButton'])) {
    # code...
    $nameItemD = $_POST['itemNameInsert'];
    $detailsItemD = $_POST['itemDetailInsert'];
    $priceItemD = $_POST['itemPriceInsert'];
    $productQuantity = $_POST['itemQuantityInsert'];
    $imageItemD2 = $imageDisplay;
    // $imageItemD = $_FILES['itemImageInsert']['name']; # image name
    // $imageItemTMPD = $_FILES['itemImageInsert']['tmp_name']; #temporary image name
    // $imageItemFolderD= 'cart/'.basename($_FILES['itemImageInsert']['name']); # image folder

    $cartTableProducts = "select * from cart where itemidno='$idtoupdate'";
    $select_cart = mysqli_query($connectphp, $cartTableProducts);

    if (mysqli_num_rows($select_cart)>0) {
        # code...
        echo '<script>alert("Product Already Added to the cart. Please modify the quantity in the shopping basket.") </script>';
       # header("location:buyproducts.php"); 
    } else {
        # code...
    
    $sqlInsert = "insert into cart
    (name, price, image, quantity, itemidno) 
    values ('$nameItemD', '$priceItemD', '$imageItemD2', $productQuantity, $idtoupdate)";


    # $connectphp is the variable which has been created inside the coonect.php file
    # this mysqli_query takes two arguments. first one is $con to connect to the database
    #second one is the $sqlinsertdataintotable query variable to insert the data from the database. 

    $updateResult = mysqli_query($connectphp, $sqlInsert );

    if ($updateResult) {

        # method to collect and store the image path inside the database
        move_uploaded_file($imageItemTMPD, $imageItemFolderD);
                   
        # code...
        #echo '<script>alert("Data has been updated in table named goods successfully")</script>';
        header("location:cart.php");    
    
    } else {
            # code...
        echo ("There is an error to connect to the database. 
        Please check your internet, connection or codes.");
        die(mysqli_error());
           
        }
    }
};

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
<section>
<h3 class="text-center mb-3 text-danger">Add To Cart</h3>

<!-- <a href="user.php" class="btn btn-outline-primary btn-lg" style="margin-top: .5rem;">Add New User</a> -->
</div>
<div class="container my-2">

<form action="" class="addNewItem" method="post" enctype="multipart/form-data">
    <!-- <input type="text" class="insertItem" name="itemNameInsert" placeholder="Insert Item's Name" required>
    <input type="text" class="insertItem" name="itemDetailsInsert" placeholder="Item's Details" required>
    <input type="number" class="insertItem" name="itemPriceInsert" min="0" placeholder="Item's Price" required>
    <input type="file" class="insertItem" name="itemImageInsert" placeholder="Item's Image" required>
    <input type="submit" class="submitButton" value="Upload New Item"> -->

    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Name:</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" name="itemNameInsert" id="" minlength="2" maxlength="50" value=<?php echo $nameDisplay ?> required readonly>
    </div>
</div>

    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Description:</label>
      <div class="col-sm-10">
      <textarea class="form-control" name="itemDetailInsert" id="" rows="3" minlength="4" maxlength="300" required readonly><?php echo $detailsDisplay ?></textarea>
    </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Price:</label>
      <div class="col-sm-10">
      <input type="number" class="form-control" min="10" name="itemPriceInsert" id="" value=<?php echo $priceDisplay ?> required readonly>
    </div>
</div>

<div class="row mb-3">
      <label class="col-sm-2 col-form-label">Image:</label>
      <div class="col-sm-10">
      <img src="image/<?php echo $imageDisplay;?>" alt="<?php echo $nameDisplay?>" width="200" height="200"> 
    </div>
</div>

<div class="row mb-3">
      <label class="col-sm-2 col-form-label">Quantity:</label>
      <div class="col-sm-10">
      <input type="number" class="form-control" name="itemQuantityInsert" id="" value="1" required>
    </div>
</div>
 

<button type="submit" class="btn btn-outline-success btn-lg"  style="margin-top: .5rem; margin-left: 25rem;" name="addToCartButton">Add To Basket</button>
  <a href="buyproducts.php" class="btn btn-outline-danger btn-lg" style="margin-top: .5rem;">Cancel</a>
  <a href="cart.php" class="btn btn-outline-dark btn-lg" style="margin-top: .5rem;">Go to Cart</a>

</form>



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