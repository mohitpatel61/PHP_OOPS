<?php
require_once 'views/common/header.php';
?>
<?php if (isset($message)) { echo "<p>$message</p>"; } ?>

    <h2>Login Form</h2>
    <!-- <form method="POST" action="/login"> -->
    <form id="loginForm" method="POST" action="/user-login">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <?php foreach ($this->getScripts() as $script) { ?>
    <script src="<?php echo $script; ?>" defer></script>
    <?php } ?>
        
<?php
require_once 'views/common/footer.php';
?>
