<?php
namespace MHN\Akademie;

require_once '../lib/base.inc.php';

// GET[y]: Jahr der Akademie (mindestens 2017, default ist das aktuelle Jahr)
ensure($_GET['y'], ENSURE_INT_GTEQ, 2017, (int)date('Y'));

$year = $_GET['y'];

Tpl::set('year', $year);
Tpl::set('navId', 'programm');

// Die Beitragsdaten werden gecached und erst nach 180sek. erneut vom Referententol angefragt.
$cachePath = '/tmp/programm_' . $year . '.cache.json';
if (!is_file($cachePath) || time() - filemtime($cachePath) > 180) {
    $response = API::erfrageBeitraegeVonRT($year, 'MA' . $year);

    if (isset($response['success']) && $response['success'] === true) {
        $cacheHandle = fopen($cachePath, 'w');
        fwrite($cacheHandle, json_encode($response['data']));
        fclose($cacheHandle);
    }
}

$beitraege = is_file($cachePath) ? json_decode(file_get_contents($cachePath), true) : [];
Tpl::set('beitraege', $beitraege);

// PDF im Ordner assets suchen. Dateiname: "Programmplan $year.pdf".
$pdfFile = 'Programmplan ' . $year . '.pdf';
if (is_file(__DIR__ . '/assets/' . $pdfFile)) {
    Tpl::set('pdfFile', $pdfFile);
}

Tpl::render('programm');

Tpl::submit();
