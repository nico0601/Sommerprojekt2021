<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  include "header.php";
  ?>
    <title>F.A.S.T</title>
    <link rel="stylesheet" href="index.css">
    <script src="index.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dashjs/3.2.2/dash.all.min.js" defer></script>
</head>
<body>
<?php
include "nav.php";
?>
<div id="video">
    <video class="videoElement" preload="none" autoplay muted loop>
        <source src="video/FAST_manifest.xml" type="application/dash+xml"/>
        <source src="video/FAST_160x90_250k.webm" type="video/webm">
    </video>

    <div class="videoOverlay">
        <img id="logo" src="images/logo%20-%20hell.png" alt="Logo">
        <div id="buttonDiv">
            <a href="kontakt.php" class="infoA">
                <button type="button" class="button infoButton">Kontakt</button>
            </a>
            <a href="termin.php" class="infoA">
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
            <img src="images/pfeil.png" class="nav" id="buttonLeft1" alt="<-">
            <div class="item therapie">
                <a href="therapie.php" class="angebotA">
                    <button type="button" class="button">klassische Massage</button>
                </a>
            </div>
            <div class="item therapie">
                <a href="therapie.php" class="angebotA">
                    <button type="button" class="button">Sportmassage</button>
                </a>
            </div>
            <div class="item therapie">
                <a href="therapie.php" class="angebotA">
                    <button type="button" class="button">Faszientherapie</button>
                </a>
            </div>
            <div class="item therapie">
                <a href="therapie.php" class="angebotA">
                    <button type="button" class="button">FUZO</button>
                </a>
            </div>
            <div class="item therapie">
                <a href="therapie.php" class="angebotA">
                    <button type="button" class="button">Lymphdrainage</button>
                </a>
            </div>
            <img src="images/pfeil.png" class="nav" id="buttonRight1" alt="->">
        </div>
        <div class="description">
            <img src="images/pfeil.png" class="nav" id="buttonLeft2" alt="<-">
            <div class="item training">
                <a href="training.php" class="angebotA">
                    <button type="button" class="button">Functional Training</button>
                </a>
            </div>
            <div class="item training">
                <a href="training.php" class="angebotA">
                    <button type="button" class="button">Faszientraining</button>
                </a>
            </div>
            <div class="item training">
                <a href="training.php" class="angebotA">
                    <button type="button" class="button">Speedtraining</button>
                </a>
            </div>
            <div class="item training">
                <a href="training.php" class="angebotA">
                    <button type="button" class="button">Testing</button>
                </a>
            </div>
            <div class="item training">
                <a href="training.php" class="angebotA">
                    <button type="button" class="button">Nutrition, Gewichtsmanagement</button>
                </a>
            </div>
            <img src="images/pfeil.png" class="nav" id="buttonRight2" alt="->">
        </div>
    </div>
</section>
<img src="images/weiter.png" alt="weiter" id="weiter">
<?php
include "footer.php";
?>
</body>
</html>