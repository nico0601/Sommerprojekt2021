<?php

use Doctrine\DBAL\DriverManager;

include "../admin/adminSpaceHeader.php";
include_once __DIR__ . "/getPDO.php";

// Report all PHP errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function var_dump_pre($mixed = null)
{
    echo '<pre>';
    echo htmlspecialchars(var_dump_ret($mixed));
    echo '</pre>';
    return null;
}

function var_dump_ret($mixed = null)
{
    ob_start();
    var_dump($mixed);
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

//$conn = DriverManager::getConnection(array(
//    'dbname' => 'fast_db',
//    'user' => 'phpUser',
//    'password' => 'DanielleAndDorkaAreMyCuddles',
//    'host' => 'localhost',
//    'driver' => 'pdo_mysql'));
//
//$queryBuilder = $conn->createQueryBuilder();

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (array_key_exists('id', $_GET)) {
        $queryBuilder = getPDO();
        $queryBuilder->delete('beschreibungTh')
            ->where('pk_beschreibungTh_id = :id')
            ->setParameter('id', $_GET['id']);
        $queryBuilder->executeStatement();
        echo 'Deleted it';
    } else {
        echo 'Nothing';
    }
}