<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <?php
  include "header.php"
  ?>
    <title>F.A.S.T - Über mich</title>
    <link rel="stylesheet" href="/ueberMich.css">
</head>
<body>

<?php
include "nav.php"
?>
<div id="heading">
    <h1>Über mich</h1>
</div>
<section id="content">
    <div class="contentSection">
        <div class="description">
            <div class="item">
                <p class="blue oswald left2">Name</p>
                <p class="oswald left">Christian Werdenich</p>
                <img class="person" src="/images/Person-echt.jpg" alt="Gründer-Foto">
                <p class="oswald left">Therapeut, Trainer</p>
                <p class="blue oswald left2">Position</p>
            </div>
            <div class="item">
                <p class="blue oswald left3">Information</p>
                <?php
                include "getPDO.php";

                $queryBuilder = getPDO()
                    ->select("*")
                    ->from('ueber_mich');
                $stmt = $queryBuilder->fetchAllAssociative();

                foreach ($stmt as $ueber_mich) {
                    echo "<p id='descriptionText'>".nl2br($ueber_mich["infotext"])."</p>";
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
include "footer.php"
?>
</body>
</html>