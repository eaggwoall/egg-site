<?php include 'includes/header.php'; ?>

    <?php
		$product = $_POST["product"];
	?>

    <main style="padding: 40px;">
        <h2>Item Added</h2>
        <p>Product <?php echo $product; ?> sucessfully added to cart.</p>
        <br>
        <a href="index.php">Continue Shopping</a>
    </main>
    
    <!--
    <script>
        const params = new URLSearchParams(window.location.search);
        const productName = params.get("item");
        const messageElement = document.getElementById("confirmationMessage");

        if (productName) {
            messageElement.textContent = productName + " successfully added to cart.";
        } else {
            messageElement.textContent = "No product selected.";
        }
    </script>
    -->
</body>
</html>