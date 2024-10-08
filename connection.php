<?php
$serverName = "localhost";
$databaseUsername = "root";
$databasePassword = "";
$databaseName = "library_system";

$conn = mysqli_connect($serverName, $databaseUsername, $databasePassword, $databaseName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}