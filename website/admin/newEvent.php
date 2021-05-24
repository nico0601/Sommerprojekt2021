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
    <link rel="stylesheet" href="newEvent.css">
</head>
<body>
<?php
include "../nav.php";
?>

<div id="heading">
    <h1>Add Event</h1>
</div>

<section id="content">
    <div class="contentSection">
        <div class="description">
            <form action="editEvent.php" method="post">
                <div id="linkDiv">
                    <label for="link">Bild-Link:</label>
                    <input type="text" id="link" name="link" placeholder="z.B. /images/Event.jpg">
                </div>
                <input type="submit" id="formButton" value="Erstellen">
            </form>
        </div>
    </div>
</section>

<?php
include "../footer.php";
?>
</body>
</html>
