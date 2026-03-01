<?php
session_start();

// Only allow access for users with the 'admin' role
$username = $_SESSION['username'] ?? '';
$role = $_SESSION['role'] ?? '';
if (($role ?? '') !== 'admin') {
  // Optionally set an error message for the login page
  $_SESSION['login_error'] = 'You must be an admin to access that page.';
  header('Location: adminlogin.php');
  exit();
}

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="style.css" />
  <link rel="javacript" href="script.js" />
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <title>Jackson's Internet Garden - Admin Page</title>
</head>

<body class="panel">
  <div class="container">
    <!-- side bar -->
    <div class="sidebar-panel-left">
      <a href="main.php"><img src="assets/logo.png" class="logo" /> </a>
      <img src="assets/dividerresources.gif" class="divider-resources" />
      <h2 class="sidebar-title">Navigation</h2>
      <img src="assets/dividerresources.gif" class="divider-resources" />
      <ul class="sidebar-list">
        <li><a href="main.php">Home</a></li>
        <li><a href="videogames.php">Video Games</a></li>
        <li><a href="music.php">Music</a></li>
        <li><a href="projects.php">Projects</a></li>
        <li><a href="blog.php">Blog</a></li>
        <li><a href="resources.php">Resources</a></li>
        <li><a href="about.php">About Me</a></li>
        <?php if ($username): ?>
          <form action="logout.php" method="post" style="display:inline">
            <button type="submit" class="logout-btn">Logout</button>
          </form>
        <?php endif; ?>
      </ul>
      <img src="assets/dividerresources.gif" class="divider-resources" />
      <img
        src="assets/home-accents/gardenbutton.gif"
        style="padding-top: 20px" />
    </div>
    <div class="main-content-panel">
      <!-- Header of the main home landing page-->
      <div class="header-panel">
        <h1 class="titleADMIN"><span>Admin Panel</span></h1>
        <?php if ($username): ?>
          <p class="user-info">Logged in as <?= htmlspecialchars($username) ?>
            <?= $role ? ' (' . htmlspecialchars($role) . ')' : '' ?></p>
        <?php endif; ?>
      </div>
      <div class="introADMIN">
        <h2>Total User Information:</h2>
        <div class="info-display-total">
          <p class="introHOME-text"><u>Total Users: </u></p>
          <p class="introHOME-text"><u>Active Users: </u></p>
        </div>
      </div>
    </div>
    <div class="sidebar-panel-right">
      <!-- <img src="assets/dividerresources.gif" class="divider-resources" />
      <img src="assets/dividerresources.gif" class="divider-resources" />
      <img src="assets/dividerresources.gif" class="divider-resources" /> -->
    </div>
  </div>
</body>

</html>