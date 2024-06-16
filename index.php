<?php

$content = '
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="src/app.css">
    <script src="src/app.js"></script>
</head>
<body>
<div class="container">
<img class="logo" src="src/img/logo.png" alt="Logo">
<h1>Fotobox Bilder</h1>
<div class="description">Hier finden Sie alle Bilder, die mit der Fotobox aufgenommen wurden. Durch einen Klick wird das jeweilige Bild direkt heruntergeladen.</div>
<div class="image-grid">';

$directory = "images/";
$images = glob($directory . '*.jpg') + glob($directory . '*.png');

usort($images, static function ($a, $b) {
    return filemtime($b) - filemtime($a);
});

foreach ($images as $image) {
    $urlEncodedFile = urlencode($image);
    $date = new DateTime();
    $date->setTimestamp(filemtime($image));

    $dateTime = $date->format('d.m.Y H:i:s');

    $content .= <<<EOF
    <figure>
         <a class="image-grid__image-wrapper" href="download.php?file=$urlEncodedFile" target="_blank">
            <img loading="lazy" class="image-grid__image" src="$image">
        </a>
        <figcaption>$dateTime</figcaption>
    </figure>
EOF;
}

$content .= '
</div>
</div>
</body>
</html>';

echo $content;