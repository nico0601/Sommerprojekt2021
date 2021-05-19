<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;

include "../vendor/autoload.php";

function getPDO()
{
    // Test-Zweck (Bplaced):
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

    $conn = DriverManager::getConnection(array(
        'dbname' => 'fast_db',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql'));
    return $queryBuilder = $conn->createQueryBuilder();

}