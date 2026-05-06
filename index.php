<?php
include 'includes/header.php';
include 'includes/dbconnect.php';

// get filters from URL
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : '';

// Build the shared filters first so the price slider range matches the
// category/search results before the max-price filter is applied.
$baseWhere = " WHERE 1=1";
if ($selectedCategory != '') {
    $baseWhere .= " AND category = '$selectedCategory'";
}
if ($search != '') {
    $baseWhere .= " AND (name LIKE '%$search%' OR description LIKE '%$search%')";
}

$priceRangeSql = "SELECT MIN(price) AS minPrice, MAX(price) AS maxPrice FROM Products" . $baseWhere;
$priceRangeResult = mysqli_query($conn, $priceRangeSql);
$priceRange = mysqli_fetch_assoc($priceRangeResult);
$sliderMin = ($priceRange && $priceRange['minPrice'] !== null) ? floor($priceRange['minPrice']) : 0;
$sliderMax = ($priceRange && $priceRange['maxPrice'] !== null) ? ceil($priceRange['maxPrice']) : 0;
$hasPriceRange = $sliderMax > 0;

if ($maxPrice == '' && $hasPriceRange) {
    $maxPrice = $sliderMax;
}
if ($maxPrice != '' && $hasPriceRange) {
    $maxPrice = min(max((float)$maxPrice, $sliderMin), $sliderMax);
}

// SQL query
$sql = "SELECT prodID, name, description, price, category FROM Products" . $baseWhere;
if ($maxPrice != '') {
    $sql .= " AND price <= '$maxPrice'";
}
$sql .= " ORDER BY name";
$result = mysqli_query($conn, $sql);

// set the page title
if ($selectedCategory != '') {
    $pageTitle = ucfirst($selectedCategory) . " - Products";
} else {
    $pageTitle = "All Products";
}
?>

<header id="categoryHeader">
    <div class="filterHeader">
        <div class="filterHeaderTop">
            <div class="categoryTitleGroup">
                <h2>Search &amp; Categories</h2>
                <button id="toggleHeader" type="button">-</button>
            </div>
            <form class="searchBox" action="index.php" method="GET">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search products">
                <input class="searchButton" type="submit" value="Search">
            </form>
        </div>

        <form id="categoryContent" class="filterHeaderControls" action="index.php" method="GET">
            <div class="checkFilters">
                <label class="categorybtn"><input type="radio" name="category" value="" <?php if ($selectedCategory == '') echo "checked"; ?>> All</label>
                <?php
                $filterCatQuery = "SELECT DISTINCT category FROM Products WHERE category IS NOT NULL AND category != ''";
                $filterCatResult = mysqli_query($conn, $filterCatQuery);
                while ($filterCatRow = mysqli_fetch_assoc($filterCatResult)) {
                    $filterCat = htmlspecialchars($filterCatRow['category']);
                    $checked = ($selectedCategory == $filterCatRow['category']) ? "checked" : "";
                    echo "<label class='categorybtn'><input type='radio' name='category' value='$filterCat' $checked> $filterCat</label>";
                }
                ?>
            </div>

            <div class="priceSlider">
                <label for="maxPrice">Max Price: $<span id="maxPriceValue"><?php echo number_format((float)$maxPrice, 2); ?></span></label>
                <input type="range"
                       id="maxPrice"
                       name="maxPrice"
                       min="<?php echo $sliderMin; ?>"
                       max="<?php echo $sliderMax; ?>"
                       step="0.01"
                       value="<?php echo htmlspecialchars($maxPrice); ?>"
                       <?php if (!$hasPriceRange) echo "disabled"; ?>>
                <div class="priceRangeText">
                    <span>$<?php echo number_format($sliderMin, 2); ?></span>
                    <span>$<?php echo number_format($sliderMax, 2); ?></span>
                </div>
            </div>

            <input class="filterButton" type="submit" value="Filter">
        </form>
    </div>
</header>

<main class="catalog">
    <h2 id="categoryTitle"><?php echo $pageTitle; ?></h2>

    <div class="productContainer">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $prodID = $row['prodID'];
                $name = htmlspecialchars($row['name']);
                $desc = htmlspecialchars($row['description']);
                $price = number_format($row['price'], 2);
                ?>
                <div class="item">
                    <h3><?php echo $name; ?></h3>
                    <?php if ($desc) echo "<p><small>$desc</small></p>"; ?>
                    <p>$<?php echo $price; ?></p>
                    <form action="confirm.php" method="POST">
                        <input type="hidden" name="product" value="<?php echo $name; ?>">
                        <input type="hidden" name="prodID" value="<?php echo $prodID; ?>">
                        <label for="qty<?php echo $prodID; ?>">Qty</label>
                        <input type="number" id="qty<?php echo $prodID; ?>" name="qty" min="1" max="10" value="1" required>
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
                <?php
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
