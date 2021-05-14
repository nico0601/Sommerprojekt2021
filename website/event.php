<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  include "header.php"
  ?>
    <title>F.A.S.T - Events</title>
    <link rel="stylesheet" href="/event.css">
</head>
<body>
<?php
include "nav.php"
?>
<div id="heading">
    <h1>Events</h1>
</div>
<section id="content">
    <div class="contentSection">
        <div class="description">
            <?php
            include "getPDO.php";

            $stmt = getPDO()->prepare("SELECT * FROM event");
            $stmt->execute();
            $stmt = $stmt->fetchAll();

            foreach ($stmt as $event) {
                echo <<<ENDE
            <div class="item">
                <img class="event" src="$event[0]" alt="Event">
            </div>
ENDE;
            }
            ?>
        </div>
        <div class="contentInfo">
            <p>Bei Interesse entweder</p>
            <p class="bold">telefonisch (+43 660 12345678)</p>
            <p>oder</p>
            <p class="bold">per Email (fascial.sportstherapy@gmail.com)</p>
            <p>Kontakt aufnehmen</p>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>
</body>
</html>