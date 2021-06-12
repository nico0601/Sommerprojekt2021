<?php
include "adminSpaceHeader.php";

if (isset($_FILES['event']['tmp_name']) && $_FILES['event']['tmp_name'] != "" &&
    filesize($_FILES['event']['tmp_name']) < 50000000) {

    $saveFolder = '../events/';
    copy($_FILES['event']['tmp_name'], $saveFolder . $_FILES['event']['name']);

    $saveFolder = '/events/';
    $_SESSION['file'] = $saveFolder . $_FILES['event']['name'];
    $_SESSION['size'] = filesize($_FILES['event']['tmp_name']);
    $_SESSION['type'] = exif_imagetype($_FILES['event']['tmp_name']);
}

header("Location: editEvent.php");