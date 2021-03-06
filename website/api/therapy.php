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

function insertDescriptions(array $descriptions, int $therapyId)
{
    foreach ($descriptions as $description) {
        $queryBuilder = getPDO();
        if (empty($description["pk_beschreibungTh_id"])) {
            $queryBuilder->insert('beschreibungTh')
                ->setValue('beschreibung', '\'' . $description["beschreibung"] . '\'')
                ->setValue('fk_pk_therapie_id', $therapyId);
        } else {
            $queryBuilder->update('beschreibungTh')
                ->set('beschreibung', ':descr')
                ->setParameter('descr', $description["beschreibung"])
                ->where('pk_beschreibungTh_id = :id')
                ->setParameter('id', $description["pk_beschreibungTh_id"]);
        }
        $queryBuilder->executeStatement();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $queryBuilder = getPDO();
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
        $queryBuilder = getPDO();

        $queryBuilder->select('pk_beschreibungTh_id, beschreibung')
            ->from('beschreibungTh')
            ->where('fk_pk_therapie_id = ?')
            ->setParameter(0, $therapy);

        $results = $queryBuilder->fetchAllAssociative();

        $therapiesOut[$therapy]['description'] = $results;
    }

    header('content-type: application/json');
    echo json_encode($therapiesOut);
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $request = file_get_contents("php://input");
    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        $data = json_decode($request, true);

        foreach ($data as $therapyId => $therapy) {
            $queryBuilder = getPDO();
            $queryBuilder->update('therapie')
                ->set('therapie_name', ':name')
                ->where('pk_th_id = :id')
                ->setParameter('name', $therapy["therapie_name"])
                ->setParameter('id', $therapyId);
            $queryBuilder->executeStatement();

            insertDescriptions($therapy["description"], $therapyId);
        }
        http_response_code(204);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo 'POST';
    $request = file_get_contents("php://input");
    if ($_SERVER['CONTENT_TYPE'] == 'application/json') {
        $data = json_decode($request, true);
        $queryBuilder = getPDO();
        if ($data != null && array_key_exists('therapie_name', $data)) {
            $queryBuilder->insert('therapie')
                ->setValue('fk_pk_id', 1)
                ->setValue('therapie_name', '\'' . $data['therapie_name'] . '\'');
        } else {
            $queryBuilder->insert('therapie')
                ->setValue('fk_pk_id', 1)
                ->setValue('therapie_name', '\'\'');
        }
        $queryBuilder->executeStatement();

        var_dump_pre($data);
        var_dump_pre($request);

        if ($data != null && array_key_exists('description', $data) && !empty($data["description"])) {
            $lastInsertId = $conn->executeQuery('SELECT LAST_INSERT_ID();');
            insertDescriptions($data['description'], $lastInsertId->fetchOne());
        }
        http_response_code(204);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (array_key_exists('id', $_GET)) {
        $queryBuilder = getPDO();
        $queryBuilder->delete('therapie')
            ->where('pk_th_id = :id')
            ->setParameter('id', $_GET['id']);
        $queryBuilder->executeStatement();
    }
}