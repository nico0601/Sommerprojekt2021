<?php

use Doctrine\DBAL\DriverManager;

include "adminSpaceHeader.php";

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

$fragment = (json_decode($_POST["fragment"]));

$conn = DriverManager::getConnection(array(
    'dbname' => 'fast_db',
    'user' => 'phpUser',
    'password' => 'DanielleAndDorkaAreMyCuddles',
    'host' => 'localhost',
    'driver' => 'pdo_mysql'));

$queryBuilder = $conn->createQueryBuilder();

$queryBuilder->delete('therapie');
try {
    $queryBuilder->executeQuery();
} catch (\Doctrine\DBAL\Exception $e) {
    echo $e;
}

$queryBuilder = $conn->createQueryBuilder();
foreach ($fragment as $therapyName => $therapy) {
    $queryBuilder->insert("therapie")
        ->values(array(
            "pk_therapie_name" => '?',
            "fk_pk_id" => '?'
        ))
        ->setParameter(0, $therapyName)
        ->setParameter(1, 1);

    foreach ($therapy as $descriptionItemName) {
        $queryBuilder = $conn->createQueryBuilder();

        $queryBuilder->insert("beschreibungTh")
            ->values(array(
                "fk_pk_therapie_name" => '?',
                "beschreibung" => '?',
                "pk_beschreibungTh_id" => '?'
            ))
            ->setParameter(0, $therapyName)
            ->setParameter(1, $descriptionItemName)
            ->setParameter(2, 1);

    }

    try {
        $queryBuilder->executeQuery();
    } catch (\Doctrine\DBAL\Exception $e) {
        echo $e;
    }
}

var_dump_pre($fragment);