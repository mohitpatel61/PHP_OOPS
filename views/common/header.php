<?php
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        nav {
            background-color: #333;
            overflow: hidden;
        }
        nav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        .right {
            float: right;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="/home">Home</a>
            <?php if ($isLoggedIn): ?>
              
                <a href="/logout" class="right">Logout</a>
            <?php else: ?>
                <a href="/login-user" class="right">Login</a>
                <a href="/register-user" class="right">Register</a>
            <?php endif; ?>
        </nav>
    </header>
