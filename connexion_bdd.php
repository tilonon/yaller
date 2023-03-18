<?php
    $servername = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "babi";

    $conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);

    if(!$conn){
        die("connexion failed".mysqli_connect_error());
    } 
?>