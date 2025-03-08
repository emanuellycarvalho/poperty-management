<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../functions/db_connect.php');
include('../functions/register.php');

if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $error = register_user($first_name, $last_name, $email, $password, $confirm_password, $role, $phone, $address);

    if (!$error) {
        $_SESSION['success'] = "Account created successfully!";
        header("Location: login.php");
        exit;
    }
}
?>

<?php include('./templates/header.php'); ?>

<section class="register-section">
    <div class="form-container">
        <h2>Register</h2>

        <?php if (isset($error)) { ?>
            <div class="alert error">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form action="register.php" method="POST">
            <div class="input-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" required>
            </div>

            <div class="input-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>

            <div class="input-group">
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="buyer">Buyer</option>
                    <option value="seller">Seller</option>
                </select>
            </div>

            <div class="input-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone">
            </div>

            <div class="input-group">
                <label for="address">Address</label>
                <textarea name="address" id="address"></textarea>
            </div>

            <button type="submit" name="register" class="btn-primary">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</section>

<?php include('./templates/footer.php'); ?>
