<?php

include "adminSpaceHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../header.php";
    ?>
    <title>F.A.S.T - edit Termine</title>
    <link rel="stylesheet" href="editTermin.css">
    <script type="text/javascript" src="../response.js" defer></script>
</head>
<body>
<?php
include "../nav.php";
include_once "Termin.php";

if (isset($_POST['delete']) && $_POST['delete'] != "") {
    $termin = new Termin($_POST['delete'], "", "", "");
    $termin->delete();
}
?>
<div id="heading">
    <h1>Edit Termine</h1>
</div>

<section id="content">
    <div class="contentSection">
        <div class="calenderDiv">
            <p class="left">Freie Termine:</p>
            <div class="calenderDivDiv">
                <?php

                $queryBuilder = getPDO()
                    ->select("*")
                    ->from('termin');
                $termine = $queryBuilder->fetchAllAssociative();

                foreach ($termine as $termin) {

                    $terminObject = new Termin($termin['pk_datum'], $termin['zeit_von'], $termin['zeit_bis'], $termin['location']);
                    $terminObject = $terminObject->getValues();

                    var_dump($terminObject['pk_datum']);

                    echo <<<ENDE
                    <div class="item calender">
                        <p class="oswald day">{$terminObject["tag"]}</p>
                        <p class="time">{$terminObject["zeit_von"]} &ndash; {$terminObject["zeit_bis"]}</p>
                        <p class="location">{$terminObject["location"]}</p>
                        <p class="blue date">{$terminObject["pk_datum"]}</p>
                        <div class="edit">
                            <form action="" method="post">
                                <button type="submit" class="x" name="delete" value="{$termin["pk_datum"]}"/>
                            </form>
                            <form action="adaptTermin.php" method="post">
                                <button type="submit" class="adapt" name="adapt" value="{$termin["pk_datum"]}"/>
                            </form>
                        </div>
                    </div>
ENDE;
                }
                ?>
            </div>
        </div>
        <div class="description">
            <form action="newTermin.php" method="post">
                <input type="submit" class="formButton" value="Neuer Termin">
            </form>
            <form action="/admin" method="get">
                <input type="submit" class="formButton" value="Zurück">
            </form>
        </div>
    </div>
</section>

<?php
include "../footer.php";
?>
</body>
</html>