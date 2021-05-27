<?php

use Doctrine\DBAL\DriverManager;

include "../admin/adminSpaceHeader.php";

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

$conn = DriverManager::getConnection(array(
    'dbname' => 'fast_db',
    'user' => 'phpUser',
    'password' => 'DanielleAndDorkaAreMyCuddles',
    'host' => 'localhost',
    'driver' => 'pdo_mysql'));

$queryBuilder = $conn->createQueryBuilder();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (array_key_exists('id', $_GET)) {
        $queryBuilder->select('pk_th_id, therapie_name')
            ->from('therapie')
            ->where('pk_th_id = ?')
            ->setParameter(0, $_GET['id']);
    } else {
        $queryBuilder->select('pk_th_id, therapie_name')
            ->from('therapie');
    }

    $results = $queryBuilder->fetchAllAssociativeIndexed();

    $therapiesOut = $results;

    foreach ($results as $therapy => $therapyDetails) {
        $queryBuilder = $conn->createQueryBuilder();

        $queryBuilder->select('*')
            ->from('beschreibungTh')
            ->where('fk_pk_therapie_id = ?')
            ->setParameter(0, $therapy);

        $results = $queryBuilder->fetchAllAssociative();

        $therapiesOut[$therapy]['description'] = $results;
    }

    header('content-type: application/json');
    echo json_encode($therapiesOut);
}

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    if (array_key_exists('id', $_GET)) {
        $request = file_get_contents("php://input");

    }
}
