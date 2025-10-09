<?php
$servername = "mysql";
$username = "root";
$password = "root";
$database = "carwashservice_db";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn) { 
    die("Connection failed: " . mysqli_connect_error()); 
} else { echo "<p class = fade-text>";
     echo "Connected successfully <br>"; 
     echo "</p>"; }