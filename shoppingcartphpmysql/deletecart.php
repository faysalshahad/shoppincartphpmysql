<?php
include "connectphp.php";
# getting the deleteID from URL.
# this deleteID has been defined in display.php
if (isset($_GET['deleteID'])) {
    # code...
    # storing the deleteID value in a variable.
    $idtodelete = $_GET['deleteID'];

    # writing SQL query to perform the delete action from the sql database
    $sqltodelete = "delete from cart where id=$idtodelete";
    #the $connectphp vairable has been declared in connect.php file 
    $resulttodelete = mysqli_query($connectphp,$sqltodelete);
    if ($resulttodelete) {
        # code...
       # echo '<script>alert("ID no $idtodelete has been deleted successfully from the database.")</script>';
        header ("location:cart.php");
    } else {
        # code...
        echo ("There is an error to connect to the database. 
        Please check your internet, connection or codes.");
        die(mysqli_error());
           
    }
}
