<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;

include "../vendor/autoload.php";

function getPDO()
{
    // Test-Zweck (Bplaced):
//    $conn = DriverManager::getConnection(array(
//        'dbname' => 'quiz_db',
//        'user' => 'quiz_admin',
//        'password' => 'quiz',
//        'host' => 'localhost',
//        'driver' => 'pdo_mysql'));
//    return $queryBuilder = $conn->createQueryBuilder();
//    $host = "localhost";
//    $db = "quiz_db";
//    $user = "quiz_admin";
//    $passwd = "quiz";
//
//    try {
//        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "$user", "$passwd");
//    } catch (PDOException $e) {
//        echo 'Verbindung fehlgeschlagen';
//    }
//    return $pdo;

    // Test-Zweck (XAMPP):
    $host = "localhost";
    $db = "fast_db";
    $user = "phpUser";
    $passwd = "DanielleAndDorkaAreMyCuddles";

    $conn = DriverManager::getConnection(array(
        'dbname' => $db,
        'user' => $user,
        'password' => $passwd,
        'host' => $host,
        'driver' => 'pdo_mysql'));
    return $queryBuilder = $conn->createQueryBuilder();

//    $host = "localhost";
//    $db = "fast_db";
//    $user = "root";
//    $passwd = "";
//
//    try {
//        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "$user", "$passwd");
//    } catch (PDOException $e) {
//        echo 'Verbindung fehlgeschlagen';
//    }
//    return $pdo;

}