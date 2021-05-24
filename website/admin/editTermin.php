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
                include_once "Termin.php";

                $queryBuilder = getPDO()
                    ->select("*")
                    ->from('termin');
                $termine = $queryBuilder->fetchAllAssociative();

                foreach ($termine as $termin) {

                    $termin = new Termin($termin);
                    $termin = $termin->getValues();

                    echo <<<ENDE
                    <div class="item calender">
                        <p class="oswald day">{$termin["tag"]}</p>
                        <p class="time">{$termin["zeit_von"]} &ndash; {$termin["zeit_bis"]}</p>
                        <p class="location">{$termin["location"]}</p>
                        <p class="blue date">{$termin["pk_datum"]}</p>
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
                <input type="submit" id="formButton" value="Neuer Termin">
            </form>
        </div>
    </div>
</section>

<?php
include "../footer.php";
?>
</body>
</html>
