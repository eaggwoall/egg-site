<?php
session_start();
include 'includes/dbconnect.php';

$username = $_POST['user'];
$password = $_POST['pass'];

// Simple query to check credentials (plaintext compare)
$sql = "SELECT c.custID, c.custName, u.password 
        FROM Customers c 
        JOIN Users u ON c.username = u.username 
        WHERE c.username = '$username' AND u.password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $nameParts = explode(" ", $row['custName']);
    $_SESSION['username'] = $username;
    $_SESSION['custID'] = $row['custID'];
    $_SESSION['custName'] = $row['custName'];
    $_SESSION['firstName'] = $nameParts[0];
    header("Location: index.php");
} else {
    echo "<h1>Login Failed</h1>";
    echo "<p>Invalid username or password.</p>";
    echo "<a href='login.php'>Try again</a>";
}
?>
