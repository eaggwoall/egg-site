<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>EggSite</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header id="mainHeader">
        <div class="headerTitleGroup">
            <h1>EggSite</h1>
            <?php if (isset($_SESSION['username'])): ?>
                <?php $displayName = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : $_SESSION['username']; ?>
                <span class="welcomeMessage">Welcome, <?php echo htmlspecialchars($displayName); ?></span>
            <?php endif; ?>
        </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="cart.php">Cart</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
            <a href="about.php">About</a>
        </nav>
    </header>
