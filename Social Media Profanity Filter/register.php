<?php
session_start();

    $host="fdb19.awardspace.net";
    $username="2665196_cse4aportal";
    $password="rudrcmkt777";
    $databasename="2665196_cse4aportal";


$conn = new mysqli($host,$username,$password,$databasename);
$code = rand();
$email = $conn->real_escape_string($_POST['email']);
$uname = $conn->real_escape_string($_POST['uname']);
$fullname = $conn->real_escape_string($_POST['fullname']);
$pass = $conn->real_escape_string($_POST['pass']);


$sql_complaint = "INSERT INTO user (uid, email, uname, fullname, pass, violationcount, ability, account_status, code, penalty) VALUES (DEFAULT, '$email','$uname', '$fullname', '$pass','0','allow','notverified','$code','0')";
$result_complaint = $conn->query($sql_complaint);
$message = 
			"
			Confirm Your Email
			Click The Link below To Verify Your Account
			http://commentfilter.rudrthakur.dx.am/email_confirm.php?uname=$uname&code=$code
			";
			mail($email,"Account Confirmation",$message,"From: hiitsme@rudrthakur.dx.am");

echo "KINDLY CHECK YOUR EMAIL AND CONFIRM YOUR REGISTRATION !";

?>