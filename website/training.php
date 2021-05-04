<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    include "header.php"
    ?>
    <title>F.A.S.T - Training</title>
    <script src="therapieTraining.js" defer></script>
    <link rel="stylesheet" href="therapieTraining.css">
</head>
<body>

<?php
include "nav.php"
?>
<div id="heading">
    <h1>Training</h1>
</div>
<section id="content">
    <div class="contentSection">
        <div class="contentHeading">
            Functional Training
        </div>
        <?php
        if (isset($_GET['angebot']) && $_GET['angebot'] !== "") {
            if ($_GET['angebot'] == 1) {
                echo "<div class='description noHidden'>";
            } else {
                echo "<div class='description hidden'>";
            }
        } else {
            echo "<div class='description hidden'>";
        }
        ?>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Kraft, Ausdauer, Balance, Beweglichkeit, Mobiltiy, Propriozeption, ...</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Ziel: Vorbereitung auf persönliche Anforderungen</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Gruppen- oder Einzeltrainings</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>mit Bodyweight Training oder mit Kettlebell, TRX, Gymball, Miniband, Plyobox, Medizinball und Co.</a>
        </div>
    </div>
    </div>

    <div class="contentSection">
        <div class="contentHeading">
            Faszientraining
        </div>
        <?php
        if (isset($_GET['angebot']) && $_GET['angebot'] !== "") {
            if ($_GET['angebot'] == 2) {
                echo "<div class='description noHidden'>";
            } else {
                echo "<div class='description hidden'>";
            }
        } else {
            echo "<div class='description hidden'>";
        }
        ?>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Training mit der foam Roll</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Gruppentraining</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>für mehr Mobilität und Range of Motion</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Verletzungsprophylaxe</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Regeneration</a>
        </div>
    </div>
    </div>

    <div class="contentSection">
        <div class="contentHeading">
            Speedtraining
        </div>
        <?php
        if (isset($_GET['angebot']) && $_GET['angebot'] !== "") {
            if ($_GET['angebot'] == 3) {
                echo "<div class='description noHidden'>";
            } else {
                echo "<div class='description hidden'>";
            }
        } else {
            echo "<div class='description hidden'>";
        }
        ?>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Analyse, Speedcheck, individuell abgestimmte Trainingspläne</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>sportartspezifisches Speedtraining</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Core Performance Training</a>
        </div>
    </div>
    </div>

    <div class="contentSection">
        <div class="contentHeading">
            Testing
        </div>
        <?php
        if (isset($_GET['angebot']) && $_GET['angebot'] !== "") {
            if ($_GET['angebot'] == 4) {
                echo "<div class='description noHidden'>";
            } else {
                echo "<div class='description hidden'>";
            }
        } else {
            echo "<div class='description hidden'>";
        }
        ?>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Muskuläre Dysbalancen</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Functional Movement Screen</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Muskelfunktionstest</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Kraft, Ausdauer, ROM</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Laufanalyse</a>
        </div>
    </div>
    </div>

    <div class="contentSection">
        <div class="contentHeading">
            Nutrition, Gewichtsmanagement
        </div>
        <?php
        if (isset($_GET['angebot']) && $_GET['angebot'] !== "") {
            if ($_GET['angebot'] == 5) {
                echo "<div class='description noHidden'>";
            } else {
                echo "<div class='description hidden'>";
            }
        } else {
            echo "<div class='description hidden'>";
        }
        ?>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Tips für die richtige Ernährung in den einzelnen Wettkampfphasen</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Was? braucht der Körper Wann?</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Isst Analyse</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Zielvereinbarung mit Monitoring (Vorher, Nachher)</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Körperfettanalyse, BMI</a>
        </div>
    </div>
    </div>
</section>

<?php
include "footer.php"
?>
</body>
</html>
