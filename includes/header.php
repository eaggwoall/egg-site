<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>EggSite</title>
    <?php if (isset($_SESSION['username'])): ?>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
    <?php endif; ?>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header id="mainHeader">
        <h1>EggShop</h1>
        <nav>
            <a href="index.php">Home</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
            <a href="about.php">About</a>
        </nav>
    </header>