<?php include 'includes/header.php'; ?>

<form id="loginForm" action="loginresult.php" method="POST">
    <fieldset id="loginBox">
        <legend id="loginLegend">Log in</legend>
        <label for="Username">Username</label>
        <input type="text" id="user" name="user" required><br>
        <label for="Password">Password</label>
        <input type="password" id="pass" name="pass" required><br>
        <input id="confirm" type="submit" value="Confirm" />
    </fieldset>
</form>
<p>Don't have an account? <a href="register.php">Register here</a></p>

<?php include 'includes/footer.php'; ?>
