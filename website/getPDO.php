<?php

function getPDO()
{
    $host = "localhost";
    $db = "fast_db";
    $user = "root";
    $passwd = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", "$user", "$passwd");
    } catch (PDOException $e) {
        echo 'Verbindung fehlgeschlagen';
    }
    return $pdo;
}