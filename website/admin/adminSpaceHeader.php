<?php
session_start();

include "../../vendor/autoload.php";

use Doctrine\DBAL\DriverManager;

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
    try {
        $dbToken = $queryBuilder->fetchOne();
        $expiryDate = date_create($dbToken);
    } catch (\Doctrine\DBAL\Exception $e) {
        echo "An error occurred. This is very probably a server error, I advice to try again in a few minutes "
            . "or <a href='/contactWebmaster.php'>contact the webmaster</a> <br /> <a href='logon.php'>Return to Login</a>";
        exit();
    }

    if (!$dbToken) {
        unset($_SESSION["token"]);
        header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/logon.php?tokenExpired");
    }

    if (date_diff($currentDate, $expiryDate)->invert == 1) {
        $queryBuilder
            ->delete("tokens")
            ->where("pk_tokenId = ?")
            ->setParameter(0, $token)
            ->executeQuery();
        unset($_SESSION["token"]);
        header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/logon.php?tokenExpired");
    }
} else {
    header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/logon.php?noToken");
}