<?php

session_start();
require_once 'config.php';

// Handle form submission for any POST request (covers clicking the button or pressing Enter)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Escape username to avoid SQL injection
    $username_escaped = $conn->real_escape_string($username);
    $sql = "SELECT * FROM users WHERE username = '$username_escaped'";
    $result = $conn->query($sql);

    if ($result === false) {
        // Query failed — helpful for debugging in development
        error_log('DB query failed: ' . $conn->error);
        $_SESSION['login_error'] = 'Server error — please try again later.';
        header("Location: adminlogin.php");
        exit();
    }

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Support both hashed passwords and legacy plain-text passwords
        $password_matches = false;
        if (!empty($user['password']) && password_verify($password, $user['password'])) {
            $password_matches = true;
        } elseif (isset($user['password']) && $password === $user['password']) {
            // Plain-text fallback (consider migrating to hashed passwords)
            $password_matches = true;
        }

        if ($password_matches) {
            // Save identifying info in session so protected pages can check it
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'] ?? '';

            if (($user['role'] ?? '') === 'admin') {
                header("Location: admin-page.php");
            } else {
                header("Location: main.php");
            }
            exit();
        }
    }

    $_SESSION['login_error'] = 'Incorrect username or password';
    header("Location: adminlogin.php");
    exit();
}
