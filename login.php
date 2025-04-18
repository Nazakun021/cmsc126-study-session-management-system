<?php
// Add these lines for detailed error reporting during development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form-container">
  <h2>Login</h2>

  <?php
    if (isset($_SESSION['error'])) {
      echo '<p class="error-message" style="color:red; text-align: center; margin-bottom: 15px;">' . htmlspecialchars($_SESSION['error']) . '</p>';
      unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
     echo '<p class="success-message" style="color:green; text-align: center; margin-bottom: 15px;">' . htmlspecialchars($_SESSION['success']) . '</p>';
     unset($_SESSION['success']);
    }
  ?>

  <form id="loginForm" action="processLogin.php" method="POST" onsubmit="return validateLogin()">

    <label for="username">Username</label>
    <input type="text" id="username" name="username" required autocomplete="username">
    <div id="usernameError" class="error"></div>
    
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required autocomplete="current-password"> <div id="passwordError" class="error"></div> <button type="submit">Login</button>
  </form>
  
  <div class="footer">
    Don't have an account? <a href="register.php" style="color: #0071e3; text-decoration: none;">Create one</a> </div>
</div>

<script src="validateLogin.js"></script> </body>
</html>