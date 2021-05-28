<?php
include "adminSpaceHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../header.php";
    ?>
    <title>F.A.S.T - Neuer Termin</title>
    <link rel="stylesheet" href="newTermin.css">
    <script type="text/javascript" src="day.js" defer></script>
</head>
<body>
<?php
include "../nav.php";
?>
<div id="heading">
    <h1>Neuer Termin</h1>
</div>

<section id="content">
    <div class="contentSection">
        <form method="post" action="editTermin.php">
            <div class="description">
                <?php

                $heute = date("Y-m-d");

                echo <<<ENDE
                <div class="item calender">
                    <input type="text" class="oswald day input" id="day" placeholder="Mo" maxlength="2" readonly>
                    <div class="timeDiv">
                        <input type="time" class="time input" name="newVon" required> <span id="dash">&ndash;</span> <input type="time" class="time input" name="newBis" required>
                    </div>
                    <input type="text" class="location input" name="newLocation" placeholder="Location" required>
                    <input type="date" class="blue date input" id="date" name="newTermin" min="$heute" pattern="\d{2}.\d{2}.\d{4}" required>
                </div>
ENDE;
                ?>
            </div>
            <div id="buttonDiv">
                <input type="submit" class="formButton" value="Erstellen">
                <a href="editTermin.php">
                    <input type="button" class="formButton" value="Zurück">
                </a>
            </div>
        </form>
    </div>
</section>

<?php
include "../footer.php";
?>
</body>
</html>