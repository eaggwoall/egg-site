<?php
include 'includes/header.php';
include 'includes/dbconnect.php';
?>

<main class="pageBox">
    <h2>Your Cart</h2>

    <?php
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        echo "<p>Your cart is empty.</p>";
        echo "<a href='index.php'>Back to Catalog</a>";
    } else {
        $total = 0;
        echo "<table class='cartTable'>";
        echo "<tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr>";

        foreach ($_SESSION['cart'] as $prodID => $qty) {
            $sql = "SELECT prodID, name, price FROM Products WHERE prodID = '$prodID'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $subtotal = $row['price'] * $qty;
            $total = $total + $subtotal;

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>$" . number_format($row['price'], 2) . "</td>";
            echo "<td>" . $qty . "</td>";
            echo "<td>$" . number_format($subtotal, 2) . "</td>";
            echo "</tr>";
        }

        echo "<tr><th colspan='3'>Total</th><th>$" . number_format($total, 2) . "</th></tr>";
        echo "</table>";
        ?>

        <form action="placeorder.php" method="POST">
            <input class="plainButton" type="submit" value="Place Order">
            <a class="plainButton" href="index.php">Continue Shopping</a>
        </form>
        <?php
    }
    ?>
</main>

<?php include 'includes/footer.php'; ?>
