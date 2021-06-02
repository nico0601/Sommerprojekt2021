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

function insertDescriptions(array $descriptions, \Doctrine\DBAL\Connection $conn, int $trainingId)
{
    foreach ($descriptions as $description) {
        $queryBuilder = $conn->createQueryBuilder();
        if (empty($description["pk_beschreibungTr_id"])) {
            $queryBuilder->insert('beschreibungTr')
                ->setValue('beschreibung', $conn->quote($description["beschreibung"]))
                ->setValue('fk_pk_training_id', $trainingId);
        } else {
            $queryBuilder->update('beschreibungTr')
                ->set('beschreibung', ':descr')
                ->setParameter('descr', $description["beschreibung"])
                ->where('pk_beschreibungTr_id = :id')
                ->setParameter('id', $description["pk_beschreibungTr_id"]);
        }
        $queryBuilder->executeStatement();
    }
}

$conn = DriverManager::getConnection(array(
    'dbname' => 'fast_db',
    'user' => 'phpUser',
    'password' => 'DanielleAndDorkaAreMyCuddles',
    'host' => 'localhost',
    'driver' => 'pdo_mysql'));

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $queryBuilder = $conn->createQueryBuilder();
    if (array_key_exists('id', $_GET)) {
        $queryBuilder->select('pk_tr_id, training_name')
            ->from('training')
            ->where('pk_tr_id = ?')
            ->setParameter(0, $_GET['id']);
    } else {
        $queryBuilder->select('pk_tr_id, training_name')
            ->from('training');
    }

    $results = $queryBuilder->fetchAllAssociativeIndexed();

    $trainingsOut = $results;

    foreach ($results as $training => $trainingDetails) {
        $queryBuilder = $conn->createQueryBuilder();

        $queryBuilder->select('pk_beschreibungtr_id, beschreibung')
            ->from('beschreibungTr')
            ->where('fk_pk_training_id = ?')
            ->setParameter(0, $training);

        $results = $queryBuilder->fetchAllAssociative();

        $trainingsOut[$training]['description'] = $results;
    }

    header('content-type: application/json');
    echo json_encode($trainingsOut);
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $request = file_get_contents("php://input");
    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        $data = json_decode($request, true);

        foreach ($data as $trainingId => $training) {
            $queryBuilder = $conn->createQueryBuilder();
            $queryBuilder->update('training')
                ->set('training_name', ':name')
                ->where('pk_tr_id = :id')
                ->setParameter('name', $training["training_name"])
                ->setParameter('id', $trainingId);
            $queryBuilder->executeStatement();

            insertDescriptions($training["description"], $conn, $trainingId);
        }
        http_response_code(204);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo 'POST';
    $request = file_get_contents("php://input");
    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        $data = json_decode($request, true);
        $queryBuilder = $conn->createQueryBuilder();
        if ($data != null && array_key_exists('training_name', $data)) {
            $queryBuilder->insert('training')
                ->setValue('fk_pk_id', 1)
                ->setValue('training_name', $conn->quote($data['training_name']));
        } else {
            $queryBuilder->insert('training')
                ->setValue('fk_pk_id', 1)
                ->setValue('training_name', $conn->quote(''));
        }
        $queryBuilder->executeStatement();

        var_dump_pre($data);
        var_dump_pre($request);

        if ($data != null && array_key_exists('description', $data) && !empty($data["description"])) {
            $lastInsertId = $conn->executeQuery('SELECT LAST_INSERT_ID();');
            insertDescriptions($data['description'], $conn, $lastInsertId->fetchOne());
        }
        http_response_code(204);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (array_key_exists('id', $_GET)) {
        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder->delete('training')
            ->where('pk_tr_id = :id')
            ->setParameter('id', $_GET['id']);
        $queryBuilder->executeStatement();
    }
}