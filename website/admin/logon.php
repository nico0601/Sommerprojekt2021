<?php

use Doctrine\DBAL\DriverManager;

session_start();

include "../../vendor/autoload.php";

if (isLoggedIn()) {
  header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/adminMain.php");
}

function isLoggedIn()
{
  if (key_exists("token", $_SESSION)) {
    $conn = DriverManager::getConnection(array(
      'dbname' => 'fastUserDb',
      'user' => 'phpUser',
      'password' => 'DanielleAndDorkaAreMyCuddles',
      'host' => 'localhost',
      'driver' => 'pdo_mysql'));
    $queryBuilder = $conn->createQueryBuilder();

    $token = $_SESSION["token"];

  }

  return false;
}

function isSecure()
{
  return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}

if (!isSecure()) {
  header("Location: https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  include "../header.php";
  ?>
    <link rel="stylesheet" href="/termin.css">
    <title>F.A.S.T</title>
</head>
<body>
<?php
include "../nav.php";
?>

<div id="heading">
    <h1>Admin Login</h1>
</div>


<?php
if (key_exists("logonFailed", $_GET)) {
  echo "<div class='error'>
    <h2>Incorrect username or password</h2>
</div>";
}

if (key_exists("tokenExpired", $_GET)) {
  echo "<div class='error'>
    <h2>Your token Expired, please log in again</h2>
</div>";
}

if (key_exists("noToken", $_GET)) {
  echo "<div class='error'>
    <h2>Please log in to access this site</h2>
</div>";
}
?>
<div class="contentSection">
    <div class="kontaktDiv">
        <form method="post" action="logonRequest.php">
            <p class="left">Login</p>
            <div id="grid">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" autocomplete="">
                <label for="passwd">Password:</label>
                <input type="password" name="passwd" id="passwd" autocomplete="current-password">
            </div>
            <input type="submit" id="formButton" value="Login">
        </form>
    </div>
</div>
<?php
include "../footer.php";
?>
</body>
</html>
