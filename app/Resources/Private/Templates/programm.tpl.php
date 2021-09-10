<h1>Programm der Mind-Akademie <?=$year?></h1>

<?php if (!empty($pdfFile)): ?>
    <p>Den Programmplan findest Du hier als <a href="<?=$pdfFile?>">PDF</a>.</p>
<?php endif; ?>

<?php \MHN\Akademie\Tpl::render('programmliste') ?>
