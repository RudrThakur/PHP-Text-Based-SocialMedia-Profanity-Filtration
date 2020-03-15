<?php
    $host="fdb19.awardspace.net";
    $username="2665196_cse4aportal";
    $password="rudrcmkt777";
    $databasename="2665196_cse4aportal";

 
// Create database connection
$conn = new mysqli($host, $username, $password, $databasename);
 
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>