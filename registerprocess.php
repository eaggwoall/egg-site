<?php
include 'includes/dbconnect.php';

$custName = $_POST['custName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];

// simple customer ID
$custID = "CUST" . rand(10000, 99999);

// insert into Customers
$sql1 = "INSERT INTO Customers (custID, custName, email, phone, username) 
         VALUES ('$custID', '$custName', '$email', '$phone', '$username')";
mysqli_query($conn, $sql1);

// insert into Users (plaintext password)
$sql2 = "INSERT INTO Users (username, password) VALUES ('$username', '$password')";
mysqli_query($conn, $sql2);

// start session and log them in
session_start();
$nameParts = explode(" ", $custName);
$_SESSION['username'] = $username;
$_SESSION['custID'] = $custID;
$_SESSION['custName'] = $custName;
$_SESSION['firstName'] = $nameParts[0];

header("Location: index.php");
?>
