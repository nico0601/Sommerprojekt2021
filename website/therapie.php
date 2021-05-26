<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "header.php"
    ?>
    <title>F.A.S.T - Therapie</title>
    <link rel="stylesheet" href="/therapieTraining.css">
    <script src="/therapieTraining.js" defer></script>
</head>
<body>

<?php
include "nav.php"
?>
<div id="heading">
    <h1>Therapie</h1>
</div>
<section id="content">
    <?php
    include "getPDO.php";

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $queryBuilder = getPDO()
        ->select("*")
        ->from('therapie');
    $therapien = $queryBuilder->fetchAllAssociative();
    $i = 1;

    foreach ($therapien as $therapie) {
        echo <<<ENDE
    <div class="contentSection">
        <div class="contentHeading">{$therapie["therapie_name"]}</div>
ENDE;

        if (isset($_GET['angebot']) && $_GET['angebot'] !== "") {
            if ($_GET['angebot'] == $i) {
                echo "<div class='description noHidden'>";
            } else {
                echo "<div class='description hidden'>";
            }
        } else {
            echo "<div class='description hidden'>";
        }

        $queryBuilder = getPDO()
            ->select("*")
            ->from('beschreibungTh')
            ->where('fk_pk_therapie_id = ?')
            ->setParameter(0, $therapie["pk_th_id"]);
        $angebote = $queryBuilder->fetchAllAssociative();

        foreach ($angebote as $angebot) {
            echo <<<ENDE
            <div class="item">
                <img class="plus" src="/images/plus.svg" alt="plus icon">
                <a>{$angebot["beschreibung"]}</a>
            </div>
ENDE;

        }

        echo "</div></div>";
        $i++;
    }
    ?>
</section>

<?php
include "footer.php"
?>
</body>
</html>