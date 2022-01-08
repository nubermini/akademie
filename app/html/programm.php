<?php
namespace MHN\Akademie;

const PATH_TO_PROGRAMM_JSON = __DIR__ . '/../Resources/Private/programm.json';

require_once '../lib/base.inc.php';

// GET[y]: Jahr der Akademie (mindestens 2017, default ist das aktuelle Jahr bzw. vor Juni das Vorjahr)
ensure($_GET['y'], ENSURE_INT_GTEQ, 2017, (int)date('Y') - ((int)date('m') < 6 ? 1 : 0));

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

$pdfFile = json_decode(file_get_contents(PATH_TO_PROGRAMM_JSON), true)[$year] ?? null;
Tpl::set('pdfFile', $pdfFile);

Tpl::render('programm');

Tpl::submit();
