<?php
session_start();
include_once "getPDO.php";
require_once "Event.php";

if (isset($_FILES['event']['tmp_name']) && $_FILES['event']['tmp_name'] != "") {
    $saveFolder = '../images/';
    copy($_FILES['event']['tmp_name'], $saveFolder . $_FILES['event']['name']);

    $saveFolder = '/images/';
    echo "Save in: ".$saveFolder . $_FILES['event']['name'];
    $_SESSION['file'] = $saveFolder . $_FILES['event']['name'];
}

header("Location: editEvent.php");