<!-- views/dashboard.php -->
<?php
require_once 'views/common/header.php';
?>
<?php if (isset($message)) { echo "<p>$message</p>"; } ?>

<h1>Welcome to the Dashboard!</h1>

<?php if (isset($data)): ?>
    <p>Welcome, <?php echo htmlspecialchars($data['name']); ?>!</p>
    <p>Email: <?php echo htmlspecialchars($data['email']); ?></p>
<?php else: ?>
    <p>No user data found.</p>
<?php endif; ?>

    
<?php
require_once 'views/common/footer.php';
?>
