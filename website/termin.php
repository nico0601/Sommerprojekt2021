<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "header.php";
    ?>
    <title>F.A.S.T - Termine</title>
    <link rel="stylesheet" href="/termin.css">
    <script type="text/javascript" src="/termin.js" defer></script>
</head>
<body>
<?php
include "nav.php";
include "getPDO.php";

//$to = "fascial.sportstherapy@gmail.com";
$to = "7157@htl.rennweg.at";

$pattern = "/^\s*$/mi";

if (isset($_POST['betreff'], $_POST['termin'], $_POST['nachricht'], $_POST['email']) &&
    !preg_match($pattern, $_POST['betreff']) && !preg_match($pattern, $_POST['termin']) &&
    !preg_match($pattern, $_POST['nachricht']) && !preg_match($pattern, $_POST['email'])) {
    $header = array(
        'From' => $_POST['email']
    );

    $termin = $_POST['termin'];
    $validtermin = false;
    $available = getPDO()->prepare("SELECT * FROM termin");
    $available->execute();
    $available = $available->fetchAll();

    foreach ($available as $termine) {
        if ($termin == $termine[0]) {
            $validtermin = true;
        }
    }

    $message = "
          Ich möchte für den " . $termin . " einen Termin anfragen!\n
          " . $_POST["nachricht"] . "\n
          Mit freundlichen Grüßen
    ";

    if ($validtermin) {
        try {
            $response = mail($to, $_POST['betreff'], $message, $header);
        } catch (Exception $ex) {}
    }else {
        $response = false;
    }
}else if (isset($_POST['betreff']) || isset($_POST['termin']) || isset($_POST['nachricht']) || isset($_POST['email'])) {
    $response = false;
}


if (isset($response) && $response) {
    echo "<div id='erfolgreich'><h2>Email erfolgreich versendet!</h2></div>";
}else if (isset($response) && $response === false) {
    echo "<div id='fehlgeschlagen' class='error'><h2>Email konnte leider nicht versendet werden!<br><span id='kleiner'>(Ist der gewählte Termin in dem Kalender angeführt?)</span></h2></div>";
}
?>
<div id="heading">
    <h1>Termine</h1>
</div>
<section id="content">
    <div class="contentSection">
        <div class="calenderDiv">
            <p class="left">Freie Termine:</p>
            <div class="calenderDivDiv">
                <?php
                $stmt = getPDO()->prepare("SELECT * FROM termin");
                $stmt->execute();
                $stmt = $stmt->fetchAll();

                foreach ($stmt as $termin) {
                    $von = explode(":", $termin[1]);
                    $von = $von[0].":".$von[1];

                    $bis = explode(":", $termin[2]);
                    $bis = $bis[0].":".$bis[1];

                    $datumArray = explode('-', $termin[0]);
                    $datum = $datumArray[2].".".$datumArray[1].".".substr($datumArray[0], 2);

                    $tag = strtotime($termin[0]);
                    $tag = date('D', $tag);

                    switch ($tag) {
                        case "Mon":
                            $tag = "Mo";
                            break;
                        case "Tue":
                            $tag = "Di";
                            break;
                        case "Wed":
                            $tag = "Mi";
                            break;
                        case "Thu":
                            $tag = "Do";
                            break;
                        case "Fri":
                            $tag = "Fr";
                            break;
                        case "Sat":
                            $tag = "Sa";
                            break;
                        case "Sun":
                            $tag = "So";
                            break;
                        default:
                            $tag = "n.V";
                    }

                    echo <<<ENDE
                <div class="item calender">
                    <p class="oswald day">$tag</p>
                    <p class="time">$von &ndash; $bis</p>
                    <p class="location">$termin[3]</p>
                    <p class="blue date">$datum</p>
                </div>
ENDE;
                }
                ?>
            </div>
        </div>
        <div class="infoDiv">
            <p class="left">Info:</p>
            <br>
            <p>
                Es gibt 3 verschiedene Arten von Terminen: Events, Hausbesuche
                und die Behandlung in der Praxis.
                <br><br><br>
                Events und die Behandlung in der Praxis sind über Telefon
                oder Email auszumachen.
                <br><br><br>
                Hausbesuche können nach telefonischer Absprache abgehalten werden.
            </p>
        </div>
        <div class="kontaktDiv">
            <form method="post" action="">
                <p class="left">Telefon:</p>
                <p id="telNr">+43 660 12345678</p>
                <p class="left">Email (keine Hausbesuche):</p>
                <div id="grid">
                    <label for="betreff">Betreff: <sup>*</sup></label>
                    <input type="text" name="betreff" id="betreff" required>
                    <label for="termin">Termin: <sup>*</sup></label>
                    <?php
                    $stmt = getPDO()->prepare("SELECT * FROM termin");
                    $stmt->execute();
                    $stmt = $stmt->fetchAll();
                    $i = 0;
                    $min = '';
                    $max = '';

                    foreach ($stmt as $termin) {
                        if ($i == 0) {
                            $min = $termin[0];
                        }
                        if ($i == sizeof($stmt)-1) {
                            $max = $termin[0];
                        }
                        $i++;
                    }

                    echo '<input type="date" name="termin" id="termin" min="'.$min.'" max="'.$max.'" pattern="\d{2}.\d{2}.\d{4}" required>'
                    ?>

                    <label for="nachricht">Nachricht: <sup>*</sup></label>
                    <div class="grow-wrap">
                        <textarea name="nachricht" id="nachricht" placeholder="Art der Behandlung..."
                                  oninput="this.parentNode.dataset.replicatedValue = this.value" required></textarea>
                    </div>
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" id="email" required>
                    <p id="required">* ... Pflichtfelder</p>
                </div>
                <p id="required">automatische Email an: fascial.sportstherapy@gmail.com</p>
                <input type="submit" id="formButton" value="Email absenden">
            </form>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>
</body>
</html>