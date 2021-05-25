<?php

include "adminSpaceHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../header.php";
    ?>
    <title>F.A.S.T - adapt Termin</title>
    <link rel="stylesheet" href="adaptTermin.css">
</head>
<body>
<?php
include "../nav.php";
?>
<div id="heading">
    <h1>Adapt Termin</h1>
</div>

<section id="content">
    <div class="contentSection">
        <form>
            <div class="description">
                <?php
                include_once "Termin.php";

                if (isset($_POST['adapt']) && $_POST['adapt'] != "") {
                    $termin = new Termin($_POST['adapt'], "", "", "");
                    $termin = $termin->getValues();

                    echo <<<ENDE
                <div class="item calender">
                    <input type="text" maxlength="2" class="oswald day" value="{$termin['tag']}">
                    <div class="timeDiv">
                        <input type="time" class="time" value="{$termin["zeit_von"]}"> <span id="dash">&ndash;</span> <input type="time" value="{$termin["zeit_bis"]}">
                    </div>
                    <input type="text" class="location" value="{$termin["location"]}">
                    <input type="date" class="blue date" value="{$_POST['adapt']}">
                </div>
ENDE;
                }
                ?>
            </div>
        </form>
        <form action="editTermin.php" method="get">
            <input type="submit" class="formButton" value="Zurück">
        </form>
    </div>
</section>

<?php
include "../footer.php";
?>
</body>
</html>