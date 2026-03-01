<?php
session_start();

$errors = ['login' => $_SESSION['login_error'] ?? ''];

session_unset();

function showError($error)
{
  return !empty($error) ? "<p class='error-msg-login'> $error </p>" : '';
}

?> <!-- If there is an error upon load, display it -->


<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="style.css" />
  <link rel="javacript" href="script.js" />
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

  <title>Admin Login - Internet Garden</title>
</head>

<body class="admin">
  <div class="login-cont">
    <div class="login-form" id="login-form">
      <!-- Login Form -->
      <form action="login_register.php" method="post" autocomplete="off">
        <h2>Login</h2>

        <?= showError($errors['login']); ?>
        <input type="text" name="username" placeholder="Admin Username" required />
        <input type="password" name="password" placeholder="Password" required />

        <button class="admin-btn" type="submit" name="login">Login</button>

        <p><a href="main.php">You're not supposed to be here, are you?</a></p>
        <img src="assets/admin-accents/susdog.jpg" class="susDog">
      </form>
    </div>
  </div>
</body>

</html>