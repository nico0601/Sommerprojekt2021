<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;

include __DIR__ . "/../vendor/autoload.php";

function getPDO()
{
    $conn = DriverManager::getConnection(array(
        'dbname' => 'fast_db',
        'user' => 'phpUser',
        'password' => 'DanielleAndDorkaAreMyCuddles',
        'host' => 'localhost',
        'driver' => 'pdo_mysql'));
    return $queryBuilder = $conn->createQueryBuilder();
}

function getUserPDO()
{
    $conn = DriverManager::getConnection(array(
        'dbname' => 'fastUserDb',
        'user' => 'phpUser',
        'password' => 'DanielleAndDorkaAreMyCuddles',
        'host' => 'localhost',
        'driver' => 'pdo_mysql'));
    return $queryBuilder = $conn->createQueryBuilder();
}

