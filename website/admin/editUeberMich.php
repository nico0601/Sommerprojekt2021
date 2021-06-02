<?php
include "adminSpaceHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../header.php";
    ?>
    <title>F.A.S.T - edit Über mich</title>
    <link rel="stylesheet" href="editUeberMich.css">
    <script type="text/javascript" src="../response.js" defer></script>
</head>
<body>
<?php
include "../nav.php";
require_once "UeberMich.php";

if (isset($_POST['infotext']) && $_POST['infotext'] != "") {
    try {
        $ueberMich = new UeberMich($_POST['infotext']);
        $ueberMich->update($_POST['infotext']);
    } catch (Exception $ex) {}
}
?>

<div id="heading">
    <h1>Edit Über mich</h1>
</div>

<section id="content">
    <div class="contentSection">
        <div class="description">
            <h2 class="blue oswald">Information</h2>
            <?php
            include_once "getPDO.php";

            $queryBuilder = getPDO()
                ->select("*")
                ->from('ueber_mich');
            $stmt = $queryBuilder->fetchAllAssociative();

            foreach ($stmt as $ueber_mich) {
                $infotext = nl2br($ueber_mich["infotext"]);
                echo <<<ENDE
                <p id='descriptionText'>$infotext</p>
                <div class="edit">
                    <form action="adaptUeberMich.php" method="post">
                        <button type="submit" class="adapt" name="adapt" value="{$ueber_mich["pk_person_id"]}"/>
                    </form>
                </div>
ENDE;
            }
            ?>
        </div>
        <div class="description">
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