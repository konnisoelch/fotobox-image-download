<?php

$file = $_GET['file'];

if (empty($file)) {
    return;
}

$fileName = urldecode($file);

list($image) = glob($fileName);

$mimeType = mime_content_type($image);

list($type, $fileType) = explode('/', $mimeType);

if (file_exists($image)) {
    header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
    header("Cache-Control: public"); // needed for internet explorer
    header("Content-Type: mime_content_type($image)");
    header("Content-Length:".filesize($image));
    header("Content-Disposition: attachment; filename=" . date('Ymd') . "_image.$fileType");
    readfile($image);
    die();
} else {
    die("Error: File not found.");
}