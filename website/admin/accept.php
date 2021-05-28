<?php
session_start();
include_once "getPDO.php";
require_once "Event.php";

if (isset($_FILES['event']['tmp_name']) && $_FILES['event']['tmp_name'] != "" &&
    filesize($_FILES['event']['tmp_name']) < 50000000) {

    $saveFolder = '../images/';
    copy($_FILES['event']['tmp_name'], $saveFolder . $_FILES['event']['name']);

    $saveFolder = '/images/';
    $_SESSION['file'] = $saveFolder . $_FILES['event']['name'];
    $_SESSION['size'] = filesize($_FILES['event']['tmp_name']);
}

header("Location: editEvent.php");