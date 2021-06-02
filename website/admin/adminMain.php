<?php

include "adminSpaceHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  include "../header.php";
  ?>
    <title>F.A.S.T - Administration</title>
</head>
<body>
<?php
include "../nav.php";
?>

<div id="heading">
    <h1>Hello Admin</h1>
</div>

<section id="content">
    <div class="contentSection">
        <div class="description">
            <form method="get" action="editEvent.php">
                <button type="submit">edit Event</button>
            </form>
            <form method="get" action="editTermin.php">
                <button type="submit">edit Termin</button>
            </form>
            <form method="get" action="editUeberMich.php">
                <button type="submit">edit Über mich</button>
            </form>
        </div>
    </div>
</section>

<?php
include "../footer.php";
?>
</body>
</html>
