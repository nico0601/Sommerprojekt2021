<?php
include "adminSpaceHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../header.php";
    ?>
    <link rel="stylesheet" type="text/css" href="adminMain.css"/>
    <title>F.A.S.T - Administration</title>
</head>
<body>
<?php
include "../nav.php";
?>

<div id="heading">
    <h1>Hello Admin</h1>
</div>

<div class="centeredFlex">
    <button onclick="location.href='editEvent.php'" class="formButton">Edit Events</button>
    <button onclick="location.href='editTermin.php'" class="formButton">Edit Calendar</button>
    <button onclick="location.href='editUeberMich.php'" class="formButton">Edit About me</button>
    <button onclick="location.href='editTherapie.php'" class="formButton">Edit Therapy</button>
    <button onclick="location.href='editTraining.php'" class="formButton">Edit Training</button>
</div>

<?php
include "../footer.php";
?>
</body>
</html>
