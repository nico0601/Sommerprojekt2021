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
  $dbToken = $queryBuilder->fetchOne();
  $expiryDate = date_create($dbToken);

  if (!$dbToken) {
    header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/logon.php?tokenExpired");
  }

  if (date_diff($currentDate, $expiryDate)->invert == 1) {
    $queryBuilder
      ->delete("tokens")
      ->where("pk_tokenId = ?")
      ->setParameter(0, $token)
      ->executeQuery();
    header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/logon.php?tokenExpired");
  }
} else {
  header("Location: https://" . $_SERVER['SERVER_NAME'] . "/admin/logon.php?noToken");
}