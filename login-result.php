<?php
session_start();
include 'includes/dbconnect.php';

$username = $_POST['user'];
$password = $_POST['pass'];

// Simple query to check credentials (plaintext compare)
$sql = "SELECT c.custId, a.password 
        FROM Customers c 
        JOIN Auth a ON c.username = a.username 
        WHERE c.username = '$username' AND a.password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $username;
    $_SESSION['custId'] = $row['custId'];
    header("Location: index.php");
} else {
    echo "<h1>Login Failed</h1>";
    echo "<p>Invalid username or password.</p>";
    echo "<a href='login.php'>Try again</a>";
}
?>