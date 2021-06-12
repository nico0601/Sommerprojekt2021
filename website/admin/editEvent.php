<?php
include "adminSpaceHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../header.php";
    ?>
    <title>F.A.S.T - edit Events</title>
    <link rel="stylesheet" href="editEvent.css">
    <script type="text/javascript" src="../response.js" defer></script>
</head>
<body>
<?php
include "../nav.php";
require_once "Event.php";

if (isset($_POST['delete']) && $_POST['delete'] != "") {
    $event = new Event($_POST['delete']);
    $event->delete();
}

if (isset($_SESSION['file']) && $_SESSION['file'] != "") {
    if (isset($_SESSION['type']) && $_SESSION['type']) {
        $event = new Event($_SESSION['file']);
        $event->insert();
        $_SESSION['file'] = "";
    } else {
        echo <<<ENDE
        <div id='fehlgeschlagen' class='error'>
            <h2>Dieses Event entspricht nicht einem der passenden Dateitypen!</h2>
        </div>
ENDE;
    }
}
?>

<div id="heading">
    <h1>Edit Events</h1>
</div>

<section id="content">
    <div class="contentSection">
        <div class="description">
            <?php
            include_once "getPDO.php";

            $queryBuilder = getPDO()
                ->select("*")
                ->from('events');
            $events = $queryBuilder->fetchAllAssociative();

            foreach ($events as $event) {
                echo <<<ENDE
            <div class="item">
                <img class="event" src="{$event["pk_event"]}" alt="Event">
                <form action="" method="post">
                    <button type="submit" class="x" name="delete" value="{$event["pk_event"]}"/>
                </form>
            </div>
ENDE;
            }
            ?>
        </div>
        <div class="description">
            <form action="newEvent.php" method="post">
                <input type="submit" class="formButton" value="Neues Event">
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
