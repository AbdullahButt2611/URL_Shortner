<?php 
    $conn = mysqli_connect("localhost", "root", "", "url_shortner");
    if(!$conn){
        echo "Database connection error".mysqli_connect_error();
    }
?>