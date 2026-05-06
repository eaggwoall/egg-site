<?php
include 'includes/header.php';
include 'includes/dbconnect.php';
?>

    <?php
		$product = $_POST["product"];
        $prodID = $_POST["prodID"];
        $qty = $_POST["qty"];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (isset($_SESSION['cart'][$prodID])) {
            $_SESSION['cart'][$prodID] = $_SESSION['cart'][$prodID] + $qty;
        } else {
            $_SESSION['cart'][$prodID] = $qty;
        }
	?>

    <main style="padding: 40px;">
        <h2>Item Added</h2>
        <p>Product <?php echo htmlspecialchars($product); ?> successfully added to cart.</p>
        <br>
        <a href="index.php">Continue Shopping</a>
        <a class="plainButton" href="cart.php">View Cart</a>
    </main>

<?php include 'includes/footer.php'; ?>
