<?php include('./templates/header.php'); ?>

<section class="login-section">
    <div class="form-container">
        <h2>Login</h2>

        <?php if (isset($error)) { ?>
            <div class="alert error">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form action="../functions/login.php" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" name="login" class="btn-primary">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Sign up here</a>.</p>
    </div>
</section>

<?php include('./templates/footer.php'); ?>
