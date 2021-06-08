<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "header.php";
    ?>
    <title>F.A.S.T</title>
    <link rel="stylesheet" href="/index.css">
    <script src="/index.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dashjs/3.2.2/dash.all.min.js" defer></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
</head>
<body>
<?php
include "nav.php";
?>
<div id="video">
    <video class="videoElement lozad" preload="none" autoplay muted loop playsinline>
        <source data-src="/video/FAST_manifest.xml" type="application/dash+xml"/>
        <source data-src="/video/FAST_160x90_250k.webm" type="video/webm">
    </video>

    <div class="videoOverlay">
        <img id="logo" src="/images/logo%20-%20hell.png" alt="Logo">
        <div id="buttonDiv">
            <a href="/kontakt" class="infoA">
                <button type="button" class="button infoButton">Kontakt</button>
            </a>
            <a href="/termine" class="infoA">
                <button type="button" class="button infoButton">Termin</button>
            </a>
        </div>
        <p id="fastText">Fascial Applied Sports Therapy</p>
    </div>
</div>
<div id="heading">
    <h1>Angebote</h1>
</div>
<section id="content">
    <div class="contentSection">
        <div class="description">
            <img src="/images/pfeil.png" class="nav" id="buttonLeft1" alt="<-">
            <form method="post" action="/therapie-angebote">

                <?php
                include __DIR__ . "/getPDO.php";

                $queryBuilder = getPDO()
                    ->select("*")
                    ->from('therapie');
                $therapien = $queryBuilder->fetchAllAssociative();
                $i = 1;

                foreach ($therapien as $therapie) {
                    echo <<<ENDE
                <div class="item therapie">
                    <a href="/therapie-angebote" class="angebotA">
                        <button type="submit" name="angebot" value="$i" class="button">{$therapie["therapie_name"]}</button>
                    </a>
                </div>
ENDE;
                    $i++;
                }
                ?>
            </form>

            <img src="/images/pfeil.png" class="nav" id="buttonRight1" alt="->">
        </div>
        <div class="description">
            <img src="/images/pfeil.png" class="nav" id="buttonLeft2" alt="<-">

            <form method="post" action="/training-angebote">
                <?php
                $queryBuilder = getPDO()
                    ->select("*")
                    ->from('training');
                $trainings = $queryBuilder->fetchAllAssociative();
                $i = 1;

                foreach ($trainings as $training) {
                    echo <<<ENDE
                <div class="item training">
                    <a href="/training-angebote" class="angebotA">
                        <button type="submit" name="angebot" value="$i" class="button">{$training["training_name"]}</button>
                    </a>
                </div>
ENDE;
                    $i++;
                }
                ?>
            </form>

            <img src="/images/pfeil.png" class="nav" id="buttonRight2" alt="->">
        </div>
        <div class="description" id="infotext">
            <h2 class="oswald blue">Information:</h2>
            <?php
            $queryBuilder = getPDO()
                ->select("*")
                ->from('ueber_mich');
            $stmt = $queryBuilder->fetchAllAssociative();

            foreach ($stmt as $ueber_mich) {
                echo "<p id='descriptionText'>" . nl2br($ueber_mich["infotext"]) . "</p>";
            }
            ?>
        </div>
    </div>
</section>
<img src="/images/weiter.png" alt="weiter" id="weiter">
<?php
include "footer.php";
?>
</body>
</html>