<?php
// Connection details
$host = "localhost";
$user = "DIDAS";
$pass = "didas07";
$database = "classified_ads_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>