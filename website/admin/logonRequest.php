<?php
session_start();

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;

include_once __DIR__ . "/../../vendor/autoload.php";
include_once __DIR__ . "/../getPDO.php";

$username = $_POST["username"];
$passwd = $_POST["passwd"];

//Login stuff

$queryBuilder = getUserPDO()
    ->select('passwdHash')
    ->from('users')
    ->where('userName = ?')
    ->setParameter(0, $username);

try {
    $queryResult = $queryBuilder->fetchOne();

    if (password_verify($passwd, $queryResult)) {
        $token = openssl_random_pseudo_bytes(64);

        $token = bin2hex($token);

        $_SESSION["token"] = $token;
        $_SESSION["userName"] = $username;

        $expiryDate = new DateTime();
        $expiryDate->modify("+1 day");

        $queryResult = getUserPDO()
            ->insert("tokens")
            ->values(
                array(
                    'pk_tokenId' => '?',
                    'expiryDate' => '?'
                )
            )
            ->setParameter(0, $token)
            ->setParameter(1, $expiryDate, Type::getType("datetimetz"));

        $result = $queryResult->executeQuery();

        header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/adminMain.php");
    } else {
        header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/logon.php?logonFailed");
    }
} catch (\Doctrine\DBAL\Exception $e) {
//    echo "An Error occurred. This is very probably a server error, I advice to try again in a few minutes "
//        . "or <a href='/contactWebmaster.php'>contact the webmaster</a> <br /> <a href='logon.php'>Return to Login</a>";
    echo $e;
}


//if (password_verify())

//header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/adminMain.php");