<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "header.php";
    ?>
    <title>F.A.S.T - Termine</title>
    <link rel="stylesheet" href="/termin.css">
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
    <script type="text/javascript" src="/response.js" defer></script>
</head>
<body>
<?php
include "nav.php";
include __DIR__ . "/getPDO.php";

$to = "fascial.sportstherapy@gmail.com";

$patternText = "/^[\wÄäöÖÜüß `'{}()%&\-@#$~!_^\/\.\n\r]*$/m";
$patternTermin = "/^\d{4}-\d{2}-\d{2}$/m";

function post($url, $postVars = array())
{
    //Transform our POST array into a URL-encoded query string.
    $postStr = http_build_query($postVars);
    //Create an $options array that can be passed into stream_context_create.
    $options = array(
        'http' =>
            array(
                'method' => 'POST', //We are using the POST HTTP method.
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postStr //Our URL-encoded query string.
            )
    );
    //Pass our $options array into stream_context_create.
    //This will return a stream context resource.
    $streamContext = stream_context_create($options);
    //Use PHP's file_get_contents function to carry out the request.
    //We pass the $streamContext variable in as a third parameter.
    $result = file_get_contents($url, false, $streamContext);
    //If $result is FALSE, then the request has failed.
    if ($result === false) {
        //If the request failed, throw an Exception containing
        //the error.
        $error = error_get_last();
        throw new Exception('POST request failed: ' . $error['message']);
    }
    //If everything went OK, return the response.
    return $result;
}

if (isset($_POST['h-captcha-response']) && $_POST['h-captcha-response'] != "") {
# PSEUDO CODE
    $SECRET_KEY = "0xCb38bf4698c81885673634B370230fC585f39f49";
    $VERIFY_URL = "https://hcaptcha.com/siteverify";

# Retrieve token from post data with key 'h-captcha-response'.
    $token = $_POST['h-captcha-response'];

# Build payload with secret key and token.
    $data = array(
        'secret' => $SECRET_KEY,
        'response' => $token
    );

# Post data to api and check
    try {
        $responseHCaptcha = post("https://hcaptcha.com/siteverify", $data);
    } catch (Exception $ex) {
    }
}

if (isset($_POST['betreff'], $_POST['termin'], $_POST['nachricht'], $_POST['email']) &&
    preg_match($patternText, $_POST['betreff']) && preg_match($patternTermin, $_POST['termin']) &&
    preg_match($patternText, $_POST['nachricht']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

    $header = array(
        'From' => $_POST['email'],
        'Content-type' => 'text/html; charset=utf8_unicode_ci',
        'Reply-To' => $_POST['email'],
        'Return-Path' => $_POST['email'],
        'X-Mailer: PHP/' => phpversion(),
        'MIME-Version' => '1.0'
    );

    $termin = $_POST['termin'];
    $validtermin = false;
    $queryBuilder = getPDO()
        ->select("*")
        ->from('termin');
    $available = $queryBuilder->fetchAllAssociative();

    foreach ($available as $termine) {
        if ($termin == $termine["pk_datum"]) {
            $validtermin = true;
        }
    }

    $termin = explode("-", $termin);
    $termin = $termin[2] . "." . $termin[1] . "." . $termin[0];

    $message = <<<ENDE
    <body>
          <p>Ich möchte für den $termin einen Termin anfragen!</p>
          <p>{$_POST["nachricht"]}</p>
          <p>Mit freundlichen Grüßen</p>
          <br>
          <p>Gesendet von: {$_POST["email"]}</p>
    </body>
ENDE;

    if ($validtermin) {
        try {
            if ($responseHCaptcha) {
                if (isset($_SESSION['betreff'], $_SESSION['termin'], $_SESSION['nachricht'], $_SESSION['email'])) {
                    if ($_SESSION['betreff'] != $_POST['betreff'] || $_SESSION['termin'] != $_POST['termin'] ||
                        $_SESSION['nachricht'] != $_POST['nachricht'] || $_SESSION['email'] != $_POST['email']) {

                        $response = mail($to, $_POST['betreff'], $message, $header);
                        $_SESSION['betreff'] = $_POST['betreff'];
                        $_SESSION['termin'] = $_POST['termin'];
                        $_SESSION['nachricht'] = $_POST['nachricht'];
                        $_SESSION['email'] = $_POST['email'];
                    } else {
                        $response = 'duplicate';
                    }
                } else {
                    $response = mail($to, $_POST['betreff'], $message, $header);
                    $_SESSION['betreff'] = $_POST['betreff'];
                    $_SESSION['termin'] = $_POST['termin'];
                    $_SESSION['nachricht'] = $_POST['nachricht'];
                    $_SESSION['email'] = $_POST['email'];
                }
            } else {
                $response = 'hCaptcha';
            }
        } catch (Exception $ex) {
        }
    } else {
        $response = 'invalidTermin';
    }
} else if (isset($_POST['betreff']) || isset($_POST['termin']) || isset($_POST['nachricht']) || isset($_POST['email'])) {
    $response = 'noMatch';
}

if (isset($response) && $response === true) {
    echo "<div id='erfolgreich'><h2>Email erfolgreich versendet!</h2></div>";
} else if (isset($response)) {
    switch ($response) {
        case 'duplicate':
            $text = "Email gerade eben erst versendet";
            break;
        case 'hCaptcha':
            $text = "hCaptcha-Check nicht erfolgreich";
            break;
        case 'invalidTermin':
            $text = "Termin nicht verfügbar";
            break;
        case 'noMatch':
            $text = "Eingaben nicht formkorrekt";
            break;
        default:
            $text = "Unbekannter Fehler aufgetreten";
            break;
    }

    echo <<<ENDE
    <div id='fehlgeschlagen' class='error'>
            <h2>Email konnte leider nicht versendet werden!
            <br>
            <span id='kleiner'>($text)</span>
        </h2>
    </div>
ENDE;
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
                include_once "admin/Termin.php";

                $queryBuilder = getPDO()
                    ->select("*")
                    ->from('termin')
                    ->orderBy('pk_datum', 'ASC');
                $termine = $queryBuilder->fetchAllAssociative();

                if (empty($termine)) {
                    echo <<<ENDE
                <div class="item calender">
                    <p class="oswald" style="word-wrap: break-word; overflow: hidden">Keine Termine verfügbar</p>
                </div>
ENDE;
                } else {
                    foreach ($termine as $termin) {

                        $termin = new Termin($termin['pk_datum'], $termin['zeit_von'], $termin['zeit_bis'], $termin['location']);
                        $termin = $termin->getValues();

                        echo <<<ENDE
                <div class="item calender">
                    <p class="oswald day">{$termin["tag"]}</p>
                    <p class="time">{$termin["zeit_von"]} &ndash; {$termin["zeit_bis"]}</p>
                    <p class="location">{$termin["location"]}</p>
                    <p class="blue date">{$termin["pk_datum"]}</p>
                </div>
ENDE;
                    }
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
                <br><br>
                Events und die Behandlung in der Praxis sind über Telefon
                oder Email auszumachen.
                <br><br>
                Hausbesuche können nach telefonischer Absprache in Wien, Niederösterreich
                und Burgenland abgehalten werden.
                <br><br>
                Termine können aus der Tabelle "Freie Termine" abgelesen werden. Bei der
                Terminauswahl sind nur verfügbare Termine anklickbar / anwählbar.
            </p>
        </div>
        <div class="kontaktDiv">
            <form method="post" action="">
                <p class="left">Telefon:</p>
                <p id="telNr">+43 664 3712860</p>
                <p class="left">Email (keine Hausbesuche):</p>
                <div id="grid">
                    <label for="betreff">Betreff: <sup>*</sup></label>
                    <input type="text" name="betreff" id="betreff" required>
                    <label for="termin">Termin: <sup>*</sup></label>
                    <?php
                    $queryBuilder = getPDO()
                        ->select("*")
                        ->from('termin')
                        ->orderBy('pk_datum', 'ASC');
                    $termine = $queryBuilder->fetchAllAssociative();
                    $i = 0;
                    $min = '';
                    $max = '';

                    foreach ($termine as $termin) {
                        if ($i == 0) {
                            $min = $termin["pk_datum"];
                            $max = $termin["pk_datum"];
                        } else {
                            if (strtotime($min) > strtotime($termin["pk_datum"])) {
                                $min = $termin["pk_datum"];
                            }
                            if (strtotime($max) < strtotime($termin["pk_datum"])) {
                                $max = $termin["pk_datum"];
                            }
                        }
                        $i++;
                    }

                    echo '<input type="date" name="termin" id="termin" min="' . $min . '" max="' . $max . '" pattern="\d{2}.\d{2}.\d{4}" required>'
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
                <div class="h-captcha" data-sitekey="957e4e38-deea-4457-bed2-ca83b9129bc1"></div>
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