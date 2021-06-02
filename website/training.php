<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    include "header.php"
    ?>
    <title>F.A.S.T - Training</title>
    <script src="/therapieTraining.js" defer></script>
    <link rel="stylesheet" href="/therapieTraining.css">
</head>
<body>

<?php
include "nav.php"
?>
<div id="heading">
    <h1>Training</h1>
</div>
<section id="content">
    <?php
    include __DIR__ . "/getPDO.php";

    $queryBuilder = getPDO()
        ->select("*")
        ->from('training');
    $trainings = $queryBuilder->fetchAllAssociative();
    $i = 1;

    foreach ($trainings as $training) {
        echo <<<ENDE
    <div class="contentSection">
        <div class="contentHeading">{$training["training_name"]}</div>
ENDE;

        if (isset($_POST['angebot']) && $_POST['angebot'] !== "") {
            if ($_POST['angebot'] == $i) {
                echo "<div class='description noHidden'>";
            } else {
                echo "<div class='description hidden'>";
            }
        } else {
            echo "<div class='description hidden'>";
        }

        $queryBuilder = getPDO()
            ->select("*")
            ->from('beschreibungTr')
            ->where('fk_pk_training_id = ?')
            ->setParameter(0, $training["pk_tr_id"]);
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