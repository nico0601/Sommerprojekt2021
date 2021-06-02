<?php
include "adminSpaceHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../header.php";
    ?>
    <title>F.A.S.T - adapt Über mich</title>
    <link rel="stylesheet" href="adaptUeberMich.css">
</head>
<body>
<?php
include "../nav.php";
?>
<div id="heading">
    <h1>Adapt Über mich</h1>
</div>

<section id="content">
    <div class="contentSection">
        <form method="post" action="editUeberMich.php">
            <div class="description">
                <?php
                include "getPDO.php";

                if (isset($_POST['adapt']) && $_POST['adapt'] != "") {

                    $queryBuilder = getPDO()
                        ->select("*")
                        ->from('ueber_mich');
                    $stmt = $queryBuilder->fetchAllAssociative();

                    foreach ($stmt as $ueber_mich) {
                        $infotext = $ueber_mich["infotext"];
                        echo <<<ENDE
                    <div class="grow-wrap">
                        <textarea name="infotext" id="infotext" placeholder="Art der Behandlung..."
                                  oninput="this.parentNode.dataset.replicatedValue = this.value" required>$infotext</textarea>
                    </div>
ENDE;
                    }
                }
                ?>
            </div>
            <div id="buttonDiv">
                <input type="submit" class="formButton" value="Über mich anpassen">
                <a href="editUeberMich.php">
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