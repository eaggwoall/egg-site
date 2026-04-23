<?php
$host = "localhost";
$user = "root";
$pass = "mysql";
$dbname = "kbdb";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    echo "<!DOCTYPE html><html><head><title>Database Connection</title></head><body>";
    if (!$conn) {
        echo "<h1>Bad</h1>";
        echo "<p>Error: " . mysqli_connect_error() . "</p>";
    } else {
        echo "<h1>Good</h1>";
        echo "<p>Successfully connected to the database " . $dbname . "</p>";
        mysqli_close($conn);
    }
    echo "</body></html>";
    exit();
}
?>