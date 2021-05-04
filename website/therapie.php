<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "header.php"
    ?>
    <title>F.A.S.T - Therapie</title>
    <link rel="stylesheet" href="therapieTraining.css">
    <script src="therapieTraining.js" defer></script>
</head>
<body>

<?php
include "nav.php"
?>
<div id="heading">
    <h1>Therapie</h1>
</div>
<section id="content">
    <div class="contentSection">
        <div class="contentHeading">
            klassische Massage
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
            <a>löst Verspannungen und Verkrampfungen in der Muskulatur</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>wohltuend, durchblutungsfördernd</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Entspannung</a>
        </div>
    </div>
    </div>

    <div class="contentSection">
        <div class="contentHeading">
            Sportmassage
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
            <a>regenerative Massage nach wettkampfmäßiger Belastung</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Behandlung von sportartspezifischen Verletzungen und Restriktionen</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Prävention von Verletzungen durch rechtzeitiges behandeln von Verhärtungen und Verspannung</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Analyse und Behandlung von strukturellen Problematiken</a>
        </div>
    </div>
    </div>

    <div class="contentSection">
        <div class="contentHeading">
            Faszientherapie
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
            <a>lösen von myofaszialen Triggerpunkten und Adhäsionen</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Myofaszial Taping und foam Rolling</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Segmentmassage</a>
        </div>
    </div>
    </div>

    <div class="contentSection">
        <div class="contentHeading">
            FUZO
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
            <a>die Fußreflexzonenmassage ist vielfältig anwendbar</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Stärkung des Parasympathikus zum Stressabbau</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>gezielte Behandlung von Magen Darmproblematiken</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>vegetativer Ausgleich und Entspannung</a>
        </div>
    </div>
    </div>

    <div class="contentSection">
        <div class="contentHeading">
            Lymphdrainage
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
            <a>Behandlung von Ödemen nach Sportverletzungen</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>regenerative Drainagen nach schweren wettkampfmäßigen Belastungen zur Vorbeugung von muskulären
                Problemen</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>klassische Lymphdrainage zur Behebung von Lymphstauproblematiken</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>Stressabbau, Entspannung</a>
        </div>
        <div class="item">
            <img class="plus" src="images/plus.svg" alt="plus icon">
            <a>bei Schlafstörungen</a>
        </div>
    </div>
    </div>
</section>

<?php
include "footer.php"
?>
</body>
</html>
