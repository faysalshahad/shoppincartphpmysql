<!--Connecting to the phpMyAdmin Database -->
<?php
include "connectphp.php";

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
<h3 class="text-center mb-3 text-danger">About KM Warehouse</h3>

<article>
    <p>We are KM Warehouse, the global warehouse brand with a city state of mind. 
        We celebrate self-expression. We learn from the past, work hard at present
         but live for the future. <br>
         We welcome the wild and free, yet hardworking individuals.
         Our collections are inspired by the demands of our clients whether the products are 
         old, refurbished and the new; For the rebel. For the life and soul. <br>
         New items are getting added to our database every moment. Our hardworking heroes set for long days and late nights.
         <br>
         We admire suggestions, but create our own path. We lead and rarely follow. We want it now, not later.
         We deliver to our customer with utmost care and cautions. <br>
         KM Warehouse is an attitude. KM Warehouse is an icon. KM Warehouse is reinvented. KM Warehouse welcomes our clients to a new era.</p>
</article>

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