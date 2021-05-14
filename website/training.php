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
    include "getPDO.php";

    $stmt = getPDO()->prepare("SELECT * FROM training");
    $stmt->execute();
    $stmt = $stmt->fetchAll();
    $i = 1;

    foreach ($stmt as $training) {
        echo <<<ENDE
    <div class="contentSection">
        <div class="contentHeading">$training[0]</div>
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

        $stmt2 = getPDO()->prepare("SELECT * FROM beschreibungTr WHERE fk_pk_training_name = ?");
        $stmt2->execute(array($training[0]));
        $stmt2 = $stmt2->fetchAll();

        foreach ($stmt2 as $angebot) {
            echo <<<ENDE
            <div class="item">
                <img class="plus" src="/images/plus.svg" alt="plus icon">
                <a>$angebot[1]</a>
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