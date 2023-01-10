<h1>Programmplan vom Symposium <!--<?=$year?>-->2024?</h1>

<p>Du willst ein Symposiumsprogramm auf dem Mensa-Jahrestreffen 2024, 2025 oder 2026 (mit)gestalten? Melde dich bei symposium at mind minus hochschul minusnetzwerk punkt de und werde aktiv!</p>

<?php if ($pdfFile !== ''): ?>
    <p>Den Programmplan findest Du hier als <a href="./assets/<?=$pdfFile?>">PDF</a>.</p>
<?php endif; ?>

<?php \MHN\Akademie\Tpl::render('programmliste') ?>
