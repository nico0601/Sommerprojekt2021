<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>F.A.S.T</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
          rel="stylesheet">
    <script src="index.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div id="video">
    <img src="images/laufen.jpg" alt="Video">
    <div>
        <img id="logo" src="images/logo%20-%20hell.png" alt="Logo">
        <div id="buttonDiv">
            <a href="kontakt.php">
                <button type="button" class="button infoButton">Kontakt</button>
            </a>
            <a href="termin.php">
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
                <a href="therapie.php">
                    <button type="button" class="button">klassische Massage</button>
                </a>
            </div>
            <div class="item therapie">
                <a href="therapie.php">
                    <button type="button" class="button">Sportmassage</button>
                </a>
            </div>
            <div class="item therapie">
                <a href="therapie.php">
                    <button type="button" class="button">Faszientherapie</button>
                </a>
            </div>
            <div class="item therapie">
                <a href="therapie.php">
                    <button type="button" class="button">FUZO</button>
                </a>
            </div>
            <div class="item therapie">
                <a href="therapie.php">
                    <button type="button" class="button">Lymphdrainage</button>
                </a>
            </div>
            <img src="images/pfeil.png" class="nav" id="buttonRight1" alt="->">
        </div>
        <div class="description">
            <img src="images/pfeil.png" class="nav" id="buttonLeft2" alt="<-">
            <div class="item training">
                <a href="training.php">
                    <button type="button" class="button">Functional Training</button>
                </a>
            </div>
            <div class="item training">
                <a href="training.php">
                    <button type="button" class="button">Faszientraining</button>
                </a>
            </div>
            <div class="item training">
                <a href="training.php">
                    <button type="button" class="button">Speedtraining</button>
                </a>
            </div>
            <div class="item training">
                <a href="training.php">
                    <button type="button" class="button">Testing</button>
                </a>
            </div>
            <div class="item training">
                <a href="training.php">
                    <button type="button" class="button">Nutrition, Gewichtsmanagement</button>
                </a>
            </div>
            <img src="images/pfeil.png" class="nav" id="buttonRight2" alt="->">
        </div>
    </div>
</section>
</body>
</html>