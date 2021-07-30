<?php
namespace MHN\Akademie;

require_once '../lib/base.inc.php';

if(isset($_GET['y']) && ensure($_GET['y'],ENSURE_INT)) {
    $year = min($_GET['y'], (int) date('Y'));
} else {
    $year = (int) date("Y");
}

while (!is_file('/var/www/Resources/Private/Templates/archiv/programm' . $year . '.tpl.php') && $year >= 2002) {
    --$year;
}
if ($year < 2002) {
    throw new \DomainException('Ungültiger Wert für $year: ' . $year, 1504629926);
}

Tpl::set('htmlTitle', 'Programm ' . $year);
Tpl::set('navId', 'Programm ' . $year);
Tpl::set('title', 'Programm der Mind-Akademie ' . $year);

Tpl::render('archiv/programm' . $year);

Tpl::submit();
