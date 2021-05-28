<?php
$datePattern = "/^[\d]{4}-[\d]{2}-[\d]{2}$/";

if (isset($_GET['date']) && $_GET['date'] != "" && preg_match($datePattern, $_GET['date'])) {
    $tag = date('D', strtotime($_GET['date']));

    switch ($tag) {
        case "Mon":
            echo "Mo";
            break;
        case "Tue":
            echo "Di";
            break;
        case "Wed":
            echo "Mi";
            break;
        case "Thu":
            echo "Do";
            break;
        case "Fri":
            echo "Fr";
            break;
        case "Sat":
            echo "Sa";
            break;
        case "Sun":
            echo "So";
            break;
        default:
            echo "n.V";
    }
}