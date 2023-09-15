<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eshopping";
# database name is crudoperation, localhost is the server, root is the user name and password field is empty
$connectphp =new mysqli($servername,$username,$password,$dbname);

if ($connectphp) {
    # code...
    # echo ("Connection to Database is Successful");
} else {
    # code...
    echo ("There is an error to connect to the database. 
    Please check your internet, connection or codes.");
    die(mysqli_error());
}

?>