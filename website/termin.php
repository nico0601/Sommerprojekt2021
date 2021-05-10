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

//$to = "fascial.sportstherapy@gmail.com";
$to = "7157@htl.rennweg.at";

$pattern = "/^\s*$/mi";

if (isset($_POST['betreff'], $_POST['termin'], $_POST['nachricht'], $_POST['email']) &&
    !preg_match($pattern, $_POST['betreff']) && !preg_match($pattern, $_POST['termin']) &&
    !preg_match($pattern, $_POST['nachricht']) && !preg_match($pattern, $_POST['email'])) {
    $header = array(
        'From' => $_POST['email']
    );

    $terminArray = explode("-", $_POST['termin']);
    $termin = $terminArray[2].".".$terminArray[1].".".$terminArray[0];
    $heute = date("d.m.Y");

    $message = "
          Ich möchte für den " . $termin . " einen Termin anfragen!\n
          " . $_POST["nachricht"] . "\n
          Mit freundlichen Grüßen
    ";

    if (strtotime($heute) <= strtotime($termin)) {
        $response = mail($to, $_POST['betreff'], $message, $header);
    }else {
        $response = false;
    }
}


if (isset($response) && $response) {
    echo "<div id='erfolgreich'>Email erfolgreich versendet!</div>";
}else if (isset($response) && $response === false) {
    echo "<div id='fehlgeschlagen'>Email konnte leider nicht versendet werden!<br><span id='kleiner'>(Ist der gewählte Termin in dem Kalender angeführt?)</span></div>";
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
                <div class="item calender">
                    <p class="oswald day">Mi</p>
                    <p class="time">08:00 &ndash; 11:30</p>
                    <p class="location">Praxis</p>
                    <p class="blue date">14.04</p>
                </div>
                <div class="item calender">
                    <p class="oswald day">Do</p>
                    <p class="time">10:00 &ndash; 11:00</p>
                    <p class="location">Event</p>
                    <p class="blue date">15.04</p>
                </div>
                <div class="item calender">
                    <p class="oswald day">Do</p>
                    <p class="time">15:00 &ndash; 16:30</p>
                    <p class="location">Praxis</p>
                    <p class="blue date">22.04</p>
                </div>
                <div class="item calender">
                    <p class="oswald day">Fr</p>
                    <p class="time">09:00 &ndash; 09:30</p>
                    <p class="location">Praxis</p>
                    <p class="blue date">23.04</p>
                </div>
                <div class="item calender">
                    <p class="oswald day">Di</p>
                    <p class="time">10:00 &ndash; 12:30</p>
                    <p class="location">Event</p>
                    <p class="blue date">27.04</p>
                </div>
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
                    <input type="date" name="termin" id="termin" required>
                    <label for="nachricht">Nachricht: <sup>*</sup></label>
                    <div class="grow-wrap">
                        <textarea name="nachricht" id="nachricht" placeholder="Art der Behandlung..."
                                  oninput="this.parentNode.dataset.replicatedValue = this.value" required></textarea>
                    </div>
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" id="email" required>
                    <p id="required">* ... Pflichtfelder</p>
                </div>
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