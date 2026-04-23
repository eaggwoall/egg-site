<?php include 'includes/header.php'; ?>

    <header id="categoryHeader">
        <div class="categoryTop">
            <h2>Quick Categories</h2>
            <button id="toggleHeader" type="button">Ʌ</button>
        </div>

        <div id="categoryContent">
            <div class="categories">
                <a href="?category=electronics" class="categorybtn">Electronics</a>
                <a href="?category=clothing" class="categorybtn">Clothing</a>
                <a href="?category=accessories" class="categorybtn">Accessories</a>
                <a href="?category=games" class="categorybtn">Games</a>
            </div>
        </div>
    </header>

    <main class="catalog">
        <h2 id="categoryTitle">All Products</h2>

        <div class="productContainer">
            <div class="item">
                <h3>Baseball</h3>
                <p>$10</p>
                <form action="confirm.php" method="POST">
                    <input type="hidden" name="product" value="baseball">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>

            <div class="item">
                <h3>Shirt</h3>
                <p>$20</p>
                <form action="confirm.php" method="POST">
                    <input type="hidden" name="product" value="shirt">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>

            <div class="item">
                <h3>Phone</h3>
                <p>$30</p>
                <form action="confirm.php" method="POST">
                    <input type="hidden" name="product" value="phone">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php' ?>