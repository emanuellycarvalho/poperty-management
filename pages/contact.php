<?php 

include('./templates/header.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['status']) && $_GET['status'] == 'success') {
    if (isset($_SESSION['success'])) {
        echo "<div class='alert success'>{$_SESSION['success']}</div>";
        unset($_SESSION['success']); 
    }
} elseif (isset($_GET['status']) && $_GET['status'] == 'error') {
    if (isset($_SESSION['error'])) {
        echo "<div class='alert error'>{$_SESSION['error']}</div>";
        unset($_SESSION['error']); 
    }
}
?>

<!-- Contact Us Section -->
<section class="contact-us">
    <div class="container">
        <h1>Contact Us</h1>
        <p>If you have any questions, feel free to reach out to us using the form below or through our contact details.</p>

        <!-- Contact Form -->
        <form action="../functions/process_contact.php" method="POST" class="contact-form">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter your name">

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email">

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" required placeholder="Write your message here"></textarea>

            <button type="submit" class="btn-primary">Send Message</button>
        </form>

        <div class="contact-details">
            <h2>Other Ways to Reach Us</h2>
            <p>Email: <a href="mailto:info@abcproperty.com">info@abcproperty.com</a></p>
            <p>Phone: <a href="tel:+61123456789">+61 123 456 789</a></p>
        </div>
    </div>

    <!-- Success/Error Message -->
    <div id="alert-container"></div>
</section>

<?php include('./templates/footer.php'); ?>

<script>
    $(document).ready(function() {
        <?php if (isset($_SESSION['success'])): ?>
            $('#alert-container').html(`
                <div class="alert success">
                    <?php echo $_SESSION['success']; ?>
                </div>
            `);
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            $('#alert-container').html(`
                <div class="alert error">
                    <?php echo $_SESSION['error']; ?>
                </div>
            `);
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    });
</script>