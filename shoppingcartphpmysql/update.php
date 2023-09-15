<!--Connecting to the phpMyAdmin Database -->
<?php
include "connectphp.php";

$idtoupdate = $_GET['updateID'];

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


if (isset($_POST['updateButton'])) {
    # code...
    $nameItemD = $_POST['itemNameInsert'];
    $detailsItemD = $_POST['itemDetailInsert'];
    $priceItemD = $_POST['itemPriceInsert'];
    $imageItemD = $_FILES['itemImageInsert']['name']; # image name
    $imageItemTMPD = $_FILES['itemImageInsert']['tmp_name']; #temporary image name
    $imageItemFolderD= 'image/'.basename($_FILES['itemImageInsert']['name']); # image folder

    $sqlUpdateQuery = "update goods set IDt = $idtoupdate,
    namet = '$nameItemD', detailst = '$detailsItemD', pricet = $priceItemD , imaget = '$imageItemD'
    where IDt = $idtoupdate";

    # $connectphp is the variable which has been created inside the coonect.php file
    # this mysqli_query takes two arguments. first one is $con to connect to the database
    #second one is the $sqlinsertdataintotable query variable to insert the data from the database. 

    $updateResult = mysqli_query($connectphp, $sqlUpdateQuery );

    if ($updateResult) {

        # method to collect and store the image path inside the database
        move_uploaded_file($imageItemTMPD, $imageItemFolderD);
                   
        # code...
        echo '<script>alert("Data has been updated in table named goods successfully")</script>';
        header("location:displayitem.php");    
    
    } else {
            # code...
        echo ("There is an error to connect to the database. 
        Please check your internet, connection or codes.");
        die(mysqli_error());
           
        }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce and Shopping Cart</title>

    <!--Linking Cascading Style Sheets File -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <!--Linking Font-Awesome Libraries-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

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
<h3 class="text-center mb-3 text-danger"> Update Items</h3>

<!-- difference between post and get method is, get method 
will display all the sensitive and other inofrmation in the 
browser url whereas post method will safely store the data and 
will not display these informtion in the browser url.
Since we are updating images to the database so we need to have enctype to
allow the form to upload the pictures in the database.-->
<form action="" class="addNewItem" method="post" enctype="multipart/form-data">
    <!-- <input type="text" class="insertItem" name="itemNameInsert" placeholder="Insert Item's Name" required>
    <input type="text" class="insertItem" name="itemDetailsInsert" placeholder="Item's Details" required>
    <input type="number" class="insertItem" name="itemPriceInsert" min="0" placeholder="Item's Price" required>
    <input type="file" class="insertItem" name="itemImageInsert" placeholder="Item's Image" required>
    <input type="submit" class="submitButton" value="Upload New Item"> -->

    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Update Name:</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" name="itemNameInsert" id="" minlength="2" maxlength="50" value=<?php echo $nameDisplay ?> required>
    </div>
</div>

    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Update Description:</label>
      <div class="col-sm-10">
      <textarea class="form-control" name="itemDetailInsert" id="" rows="3" minlength="4" maxlength="300" required><?php echo $detailsDisplay ?></textarea>
    </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Update Price:</label>
      <div class="col-sm-10">
      <input type="number" class="form-control" min="10" name="itemPriceInsert" id="" value=<?php echo $priceDisplay ?> required>
    </div>
</div>

<div class="row mb-3">
      <label class="col-sm-2 col-form-label">Exisiting Image:</label>
      <div class="col-sm-10">
      <img src="image/<?php echo $imageDisplay;?>" alt="<?php echo $nameDisplay?>" width="200" height="200"> 
    </div>
</div>

    <div class="row mb-3">
      <label class="col-sm-2 col-form-label">Update Image:</label>
      <div class="col-sm-10">
      <!-- accept="image/png, image/JPG, image/jpeg" -->
      <input class="form-control" type="file" id="" name="itemImageInsert" placeholder="Upload Item's Image Here"  required >
    </div>
</div>

<button type="submit" class="btn btn-outline-success btn-lg"  style="margin-top: .5rem; margin-left: 25rem;" name="updateButton">Update Item</button>
  <a href="index.php" class="btn btn-outline-danger btn-lg" style="margin-top: .5rem;">Cancel</a>
  <a href="displayitem.php" class="btn btn-outline-dark btn-lg" style="margin-top: .5rem;">Available Items</a>

</form>


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