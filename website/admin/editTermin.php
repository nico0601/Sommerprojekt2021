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

$datePattern = "/^[\d]{4}-[\d]{2}-[\d]{2}$/";
$timePattern = "/^[\d]{2}:[\d]{2}$/";
$locationPattern = "/^[\wÄäöÖÜüß `'|{}()%&\-@#$~!_^\/\.\n\r]*$/m";

function update($which, $set, $where)
{
    $queryBuilder = getPDO()
        ->update('termin')
        ->set($which, '?')
        ->where('pk_datum = ?')
        ->setParameter(0, $set)
        ->setParameter(1, $where);
    return $queryBuilder->executeQuery();
}

if (isset($_POST['delete']) && $_POST['delete'] != "") {
    $termin = new Termin($_POST['delete'], "", "", "");
    $termin->delete();
}

if (isset($_POST['newVon'], $_POST['newBis'], $_POST['newLocation'], $_POST['newTermin']) &&
    $_POST['newVon'] != "" && $_POST['newBis'] != "" && $_POST['newLocation'] != "" && $_POST['newTermin'] != "") {

    $termin = new Termin($_POST['newTermin'], $_POST['newVon'], $_POST['newBis'], $_POST['newLocation']);
    $termin->insert();
}

if (isset($_POST['von'], $_POST['bis'], $_POST['location'], $_POST['termin']) &&
    preg_match($timePattern, $_POST['von']) && preg_match($timePattern, $_POST['bis']) &&
    preg_match($datePattern, $_POST['termin']) && preg_match($locationPattern, $_POST['location']) &&
    preg_match($datePattern, $_SESSION['old'])) {

    $termin = new Termin($_POST['termin'], $_POST['von'], $_POST['bis'], $_POST['location']);

    if (
        update('pk_datum', $_POST['termin'], $_SESSION['old']) &&
        update('zeit_von', $_POST['von'], $_POST['termin']) &&
        update('zeit_bis', $_POST['bis'], $_POST['termin']) &&
        update('location', $_POST['location'], $_POST['termin'])) {

        $termin->success('update');
    } else {
        $termin->duplicateText('update');
    }

    $_SESSION['old'] = "";
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
                    ->from('termin')
                    ->orderBy('pk_datum', 'ASC');
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
            <form action="newTermin.php" method="get">
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
