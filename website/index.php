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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
</head>
<body>
<?php
include "nav.php";
?>
<div id="video">
    <video class="videoElement lozad" preload="none" autoplay muted loop playsinline>
        <!--        <source data-src="/video/FAST_manifest.xml" type="application/dash+xml"/>-->
        <source data-src="./video/FAST_160x90_250k.webm" type="video/webm">
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
            <form method="get" action="therapie.php">
                <div class="item therapie">
                    <a href="therapie.php" class="angebotA">
                        <button type="submit" name="angebot" value="1" class="button">klassische Massage</button>
                    </a>
                </div>
                <div class="item therapie">
                    <a href="therapie.php" class="angebotA">
                        <button type="submit" name="angebot" value="2" class="button">Sportmassage</button>
                    </a>
                </div>
                <div class="item therapie">
                    <a href="therapie.php" class="angebotA">
                        <button type="submit" name="angebot" value="3" class="button">Faszientherapie</button>
                    </a>
                </div>
                <div class="item therapie">
                    <a href="therapie.php" class="angebotA">
                        <button type="submit" name="angebot" value="4" class="button">FUZO</button>
                    </a>
                </div>
                <div class="item therapie">
                    <a href="therapie.php" class="angebotA">
                        <button type="submit" name="angebot" value="5" class="button">Lymphdrainage</button>
                    </a>
                </div>
            </form>
            <img src="images/pfeil.png" class="nav" id="buttonRight1" alt="->">
        </div>
        <div class="description">
            <img src="images/pfeil.png" class="nav" id="buttonLeft2" alt="<-">
            <form method="get" action="training.php">
                <div class="item training">
                    <a href="training.php" class="angebotA">
                        <button type="submit" name="angebot" value="1" class="button">Functional Training</button>
                    </a>
                </div>
                <div class="item training">
                    <a href="training.php" class="angebotA">
                        <button type="submit" name="angebot" value="2" class="button">Faszientraining</button>
                    </a>
                </div>
                <div class="item training">
                    <a href="training.php" class="angebotA">
                        <button type="submit" name="angebot" value="3" class="button">Speedtraining</button>
                    </a>
                </div>
                <div class="item training">
                    <a href="training.php" class="angebotA">
                        <button type="submit" name="angebot" value="4" class="button">Testing</button>
                    </a>
                </div>
                <div class="item training">
                    <a href="training.php" class="angebotA">
                        <button type="submit" name="angebot" value="5" class="button">Nutrition, Gewichtsmanagement</button>
                    </a>
                </div>
            </form>
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