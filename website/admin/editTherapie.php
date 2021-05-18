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
    <link rel="stylesheet" type="text/css" href="therapyEdit.css"
</head>
<body>
<?php
include "../nav.php";
?>

<div id="heading">
    <h1>Therapie Bearbeitungsseite</h1>
</div>

<form class="pure-form" style="margin-left: 10vw; margin-top: 20px; width: 80vw; position:relative">

    <table class="pure-table pure-table-bordered" style="table-layout: fixed; width: 80vw">
        <thead>
        <tr>
            <th style="width: max(20vw, 150px)">Therapie Name</th>
            <th>Unterpunkte</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $conn = DriverManager::getConnection(array(
          'dbname' => 'fast_db',
          'user' => 'phpUser',
          'password' => 'DanielleAndDorkaAreMyCuddles',
          'host' => 'localhost',
          'driver' => 'pdo_mysql'));
        $queryBuilder = $conn->createQueryBuilder();

        $queryBuilder
          ->select('*')
          ->from('therapie');

        $therapies = $queryBuilder->fetchAllAssociative();
        $counter = 1;
        foreach ($therapies as $therapy) {
          $therapyName = $therapy["pk_therapie_name"];

          $queryBuilder = $conn->createQueryBuilder();
          $queryBuilder
            ->select('*')
            ->from('beschreibungTh')
            ->where('fk_pk_therapie_name = ?')
            ->setParameter(0, $therapyName);

          $description = $queryBuilder->fetchAllAssociative();
          $descriptionConcat = "";
          foreach ($description as $item) {
            $descriptionConcat .= $item["beschreibung"] . ', ';
          }

          if ($counter % 2 == 0) {
            echo '<tr class="pure-table-odd">';
          } else {
            echo '<tr>';
          }
          echo <<<TABLE
<td><input class="table-input" type="text" value="$therapyName"></td>
<td class="nowrap-text">$descriptionConcat</td>
</tr>
<section>
TABLE;
          foreach ($description as $item) {
            $itemDescription = $item["beschreibung"];
            if ($counter % 2 == 0) {
              echo '<tr class="pure-table-odd">';
            } else {
              echo '<tr>';
            }
            echo <<<TABLE
<td colspan="2"><textarea class="table-input">$itemDescription</textarea></td>
</tr>
TABLE;
          }

          if ($counter % 2 == 0) {
            echo '<tr class="pure-table-odd">';
          } else {
            echo '<tr>';
          }
          echo <<<TABLE
<td colspan="2"><button class="pure-button">Add row</button></td>
</tr>
</section>
TABLE;
          $counter++;
        }


        ?>
        </tbody>
    </table>
    <button type="submit" class="pure-button pure-button-primary" style="right: 0; position:absolute;">Save changes
    </button>
</form>

<?php
include "../footer.php";
?>
</body>
</html>
