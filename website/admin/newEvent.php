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
            <form enctype="multipart/form-data" action="accept.php" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="30000000000" />
                <input type="file" name="event" accept="image/*">
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
