<h1>Programmplan vom Symposium <?=$year?></h1>

<?php if ($pdfFile !== ''): ?>
    <p>Den Programmplan findest Du hier als <a href="./assets/<?=$pdfFile?>">PDF</a>.</p>
<?php endif; ?>

<?php \MHN\Akademie\Tpl::render('programmliste') ?>
