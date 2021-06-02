<?php

use Doctrine\DBAL\DriverManager;

function var_dump_pre($mixed = null)
{
    echo '<pre>';
    echo htmlspecialchars(var_dump_ret($mixed));
    echo '</pre>';
    return null;
}

function var_dump_ret($mixed = null)
{
    ob_start();
    var_dump($mixed);
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

include "adminSpaceHeader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../header.php";
    ?>
    <title>F.A.S.T - Admin Template</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css"
          integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="therapyEdit.css">
    <script src="editTraining.js" defer></script>
</head>
<body>
<?php
include "../nav.php";
?>

<div id="heading">
    <h1>Training Bearbeitungsseite</h1>
</div>

<form class="pure-form" onsubmit="submitForm(); return false;" id="editForm"
      style="margin-left: 10vw; margin-top: 20px; margin-bottom: 100px; width: 80vw; position:relative">

    <table id="table" class="pure-table pure-table-bordered" style="table-layout: fixed; width: 80vw">
        <thead>
        <tr>
            <th style="width: max(20vw, 150px)">Training Name</th>
            <th>Unterpunkte</th>
            <th class="delete-col" style="width: 2.5em">
                <span class="material-icons delete-icon">clear</span>
            </th>
        </tr>
        </thead>
        <tr>
            <td>
                <button class="pure-button" id="add-offer" type="button">Angebot hinzufügen</button>
            </td>
            <td></td>
        </tr>
    </table>
    <button type="submit" class="pure-button pure-button-primary" style="float: right;">Save changes</button>
    <button type="button" class="pure-button" onclick="location.href = '/admin'" style="float: right">Zurück</button>
</form>

<div id="result">

</div>
<?php
include "../footer.php";
?>
</body>
</html>
