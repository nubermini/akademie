<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <title>
        <?php if (!empty($htmlTitle)): ?>
            <?=$htmlTitle?> -
        <?php endif; ?>
        Mind-Akademie
    </title>
    <link href="css/styles.css?<?=md5((string)filemtime('/var/www/html/css/styles.css'))?>" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
