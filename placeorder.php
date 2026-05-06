<?php
session_start();
include 'includes/dbconnect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: cart.php");
    exit;
}

$custID = $_SESSION['custID'];
$total = 0;

foreach ($_SESSION['cart'] as $prodID => $qty) {
    $prodSql = "SELECT price FROM Products WHERE prodID = '$prodID'";
    $prodResult = mysqli_query($conn, $prodSql);
    $prodRow = mysqli_fetch_assoc($prodResult);
    $total = $total + ($prodRow['price'] * $qty);
}

$orderSql = "INSERT INTO Orders (custID, orderMakeDate, total) VALUES ('$custID', CURDATE(), '$total')";
mysqli_query($conn, $orderSql);
$orderID = mysqli_insert_id($conn);

foreach ($_SESSION['cart'] as $prodID => $qty) {
    $prodSql = "SELECT price FROM Products WHERE prodID = '$prodID'";
    $prodResult = mysqli_query($conn, $prodSql);
    $prodRow = mysqli_fetch_assoc($prodResult);
    $price = $prodRow['price'];

    $itemSql = "INSERT INTO OrderItems (orderID, prodID, quantity, priceEach) 
                VALUES ('$orderID', '$prodID', '$qty', '$price')";
    mysqli_query($conn, $itemSql);
}

unset($_SESSION['cart']);
$_SESSION['lastOrderID'] = $orderID;

header("Location: receipt.php?orderID=$orderID");
?>
