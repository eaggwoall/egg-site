<?php include 'includes/header.php'; ?>
    <h1>Create an Account</h1>
    <form action="registerprocess.php" method="POST">
        <fieldset id="loginBox">
            <legend>Register</legend>
            <label>Full Name:</label> <input type="text" name="custName" required><br>
            <label>Email:</label> <input type="email" name="email"><br>
            <label>Phone:</label> <input type="text" name="phone"><br>
            <label>Username:</label> <input type="text" name="username" required><br>
            <label>Password:</label> <input type="password" name="password" required><br>
            <input type="submit" value="Register">
        </fieldset>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>

<?php include 'includes/footer.php'; ?>
