<?php

use Doctrine\DBAL\DriverManager;

session_start();

include "../../vendor/autoload.php";

$loginError = false;

try {
    if (isLoggedIn()) {
        header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/adminMain.php");
    }
} catch (\Doctrine\DBAL\Exception $e) {
    $loginError = true;
}

/**
 * @throws \Doctrine\DBAL\Exception
 */
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
        $queryBuilder
            ->select('expiryDate')
            ->from('tokens')
            ->where('pk_tokenId = ?')
            ->setParameter(0, $token);

        $currentDate = date_create();
        $dbToken = $queryBuilder->fetchOne();
        $expiryDate = date_create($dbToken);

        if (!$dbToken) {
            return false;
        }

        if (date_diff($currentDate, $expiryDate)->invert == 1) {
            $queryBuilder
                ->delete("tokens")
                ->where("pk_tokenId = ?")
                ->setParameter(0, $token)
                ->executeQuery();
            return false;
        }
        return true;
    }
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

if ($loginError) {
    echo "<div class='error'>
    <h2>An error occured, please try again later</h2>
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
