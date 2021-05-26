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
        <form method="post" action="editTermin.php">
            <div class="description">
                <?php
                include_once "Termin.php";

                if (isset($_POST['adapt']) && $_POST['adapt'] != "") {
                    $terminValues = new Termin($_POST['adapt'], "", "", "");
                    $terminValues = $terminValues->getValues();

                    $_SESSION['old'] = $_POST['adapt'];

                    $queryBuilder = getPDO()
                        ->select("*")
                        ->from('termin');
                    $termine = $queryBuilder->fetchAllAssociative();
                    $i = 0;
                    $min = '';
                    $max = '';

                    foreach ($termine as $termin) {
                        if ($i == 0) {
                            $min = $termin["pk_datum"];
                            $max = $termin["pk_datum"];
                        }else {
                            if (strtotime($min) > strtotime($termin["pk_datum"])) {
                                $min = $termin["pk_datum"];
                            }
                            if (strtotime($max) < strtotime($termin["pk_datum"])) {
                                $max = $termin["pk_datum"];
                            }
                        }
                        $i++;
                    }

                    echo <<<ENDE
                <div class="item calender">
                    <input type="text" class="oswald day" value="{$terminValues['tag']}" maxlength="2" required>
                    <div class="timeDiv">
                        <input type="time" class="time" name="von" value="{$terminValues["zeit_von"]}" required> <span id="dash">&ndash;</span> <input type="time" class="time" name="bis" value="{$terminValues["zeit_bis"]}" required>
                    </div>
                    <input type="text" class="location" name="location" value="{$terminValues["location"]}" required>
                    <input type="date" class="blue date" name="termin" value="{$_POST['adapt']}" min="$min" max="$max" pattern="\d{2}.\d{2}.\d{4}" required>
                </div>
ENDE;
                }
                ?>
            </div>
            <input type="submit" class="formButton" value="Adapt Termin">
        </form>
    </div>
</section>

<?php
include "../footer.php";
?>
</body>
</html>