<?php
include 'includes/header.php';
include 'includes/dbconnect.php';

$orderID = isset($_GET['orderID']) ? $_GET['orderID'] : '';
if ($orderID == '' && isset($_SESSION['lastOrderID'])) {
    $orderID = $_SESSION['lastOrderID'];
}

$orderSql = "SELECT o.orderID, o.orderMakeDate, o.total, c.custName, c.email
             FROM Orders o
             JOIN Customers c ON o.custID = c.custID
             WHERE o.orderID = '$orderID'";
$orderResult = mysqli_query($conn, $orderSql);
$order = mysqli_fetch_assoc($orderResult);
?>

<main class="pageBox">
    <h2>Receipt</h2>

    <?php if ($order) { ?>
        <p>Order #: <?php echo $order['orderID']; ?></p>
        <p>Name: <?php echo htmlspecialchars($order['custName']); ?></p>
        <p>Date: <?php echo $order['orderMakeDate']; ?></p>

        <table class="cartTable">
            <tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr>
            <?php
            $itemSql = "SELECT p.name, oi.priceEach, oi.quantity
                        FROM OrderItems oi
                        JOIN Products p ON oi.prodID = p.prodID
                        WHERE oi.orderID = '$orderID'";
            $itemResult = mysqli_query($conn, $itemSql);

            while ($row = mysqli_fetch_assoc($itemResult)) {
                $subtotal = $row['priceEach'] * $row['quantity'];
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>$" . number_format($row['priceEach'], 2) . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>$" . number_format($subtotal, 2) . "</td>";
                echo "</tr>";
            }
            ?>
            <tr><th colspan="3">Total</th><th>$<?php echo number_format($order['total'], 2); ?></th></tr>
        </table>

        <a class="plainButton" href="index.php">Back to Catalog</a>
    <?php } else { ?>
        <p>Receipt not found.</p>
    <?php } ?>
</main>

<?php include 'includes/footer.php'; ?>
