<?php
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

<div class="contentSection">
    <div class="kontaktDiv">
        <form method="post" action="logonRequest.php">
            <p class="left">Login</p>
            <div id="grid">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
                <label for="passwd">Password:</label>
                <input type="password" name="passwd" id="passwd">
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
