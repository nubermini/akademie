<?php
namespace MHN\Akademie;

/**
 * Created by PhpStorm.
 * User: guido
 * Date: 04.08.17
 * Time: 21:57
 */

require_once '../lib/base.inc.php';

// GET[y]: Jahr des Symposium (mindestens 2019, default ist das aktuelle Jahr)
ensure($_GET['y'], ENSURE_INT_GTEQ, 2019, (int)date('Y'));

$year = $_GET['y'];

Tpl::set('year', $year);
Tpl::set('navId', 'symposium_programm');

// Die Beitragsdaten werden gecached und erst nach 180sek. erneut vom Referententol angefragt.
$cachePath = '/tmp/symp_programm_' . $year . '.cache.json';
if (!is_file($cachePath) || time() - filemtime($cachePath) > 180) {
    $response = API::erfrageBeitraegeVonRT($year, 'SY' . $year);

    if (isset($response['success']) && $response['success'] === true) {
        $cacheHandle = fopen($cachePath, 'w');
        fwrite($cacheHandle, json_encode($response['data']));
        fclose($cacheHandle);
    } else if (isset($response['success']) && $response['success'] === false) {
       throw new \RuntimeException( $response['meldung'], 1514836625);
    } else {
        throw new \RuntimeException('Fehler beim Laden des Programms des MHN-Symposiums ' . $year . '.', 1514836624);
    }
}

$beitraege = json_decode(file_get_contents($cachePath), true);
Tpl::set('beitraege', $beitraege);

// neuste PDF im Ordner assets suchen. Dateiname: "Symposium-Programmplan$year$version.pdf". Die neuste Version wird ausgewählt.
$pdfDir = __DIR__ . '/assets';
$dir = dir($pdfDir);
$pdfFile = '';
while ($filename = $dir->read()) {
    if (preg_match('/^Symposium-Programmplan.*' . $year . '.*\.pdf$/', $filename) && ($pdfFile === '' || strnatcmp($filename, $pdfFile) > 0)) {
        $pdfFile = $filename;
    }
}
Tpl::set('pdfFile', $pdfFile);

Tpl::render('Symposium/symposium_programm');

Tpl::submit();
