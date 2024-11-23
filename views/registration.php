<?php
require_once 'views/common/header.php';
?>
<?php if (isset($message)) { echo "<p>$message</p>"; } ?>

    <h2>Registration Form</h2>
    <form method="POST" action="/register">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>
    <?php
require_once "views/common/footer.php";
?>
