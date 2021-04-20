<?php
namespace MHN\Akademie;

/**
 * Created by PhpStorm.
 * User: guido
 * Date: 04.08.17
 * Time: 21:57
 */

require_once '../lib/base.inc.php';

Tpl::set('navId', 'historie');

$vergangeneMAs = [
    '2019' => ['url' => 'programm.php?y=2019', 'leitthema' => 'Kopf oder Zahl', 'ort' => 'Mannheim'],
    '2018' => ['url' => 'programm.php?y=2018', 'leitthema' => 'Norm und Abweichung', 'ort' => 'Mannheim'],
    '2017' => ['url' => 'programm.php?y=2017', 'leitthema' => 'Experimente', 'ort' => 'Köln'],
    '2016' => ['url' => 'programmHistorie.php?y=2016', 'leitthema' => 'Wege - Kreuzungen - Wendepunkte', 'ort' => 'Mannheim'],
    '2015' => ['url' => '#', 'leitthema' => 'Wahrheiten und Geheimnisse', 'ort' => 'Heidelberg'],
    '2014' => ['url' => '#', 'leitthema' => 'Chaos und Ordnung', 'ort' => 'Würzburg'],
    '2013' => ['url' => '#', 'leitthema' => 'Beziehungen und Relationen', 'ort' => 'Düsseldorf'],
    '2012' => ['url' => 'programmHistorie.php?y=2012', 'leitthema' => '(R)Evolutionen', 'ort' => 'Würzburg'],
    '2011' => ['url' => 'programmHistorie.php?y=2011', 'leitthema' => 'Zukunft und Forschung', 'ort' => 'Hannover'],
    '2010' => ['url' => 'programmHistorie.php?y=2010', 'leitthema' => 'Transformation', 'ort' => 'Köln'],
    '2009' => ['url' => 'programmHistorie.php?y=2009', 'leitthema' => 'Freiheit und Grenzen', 'ort' => 'Nürnberg'],
    '2008' => ['url' => 'programmHistorie.php?y=2008', 'leitthema' => 'Zeit', 'ort' => 'Nürnberg'],
    '2007' => ['url' => 'programmHistorie.php?y=2007', 'leitthema' => 'Kreativität und Innovation', 'ort' => 'Würzburg'],
    '2006' => ['url' => 'programmHistorie.php?y=2006', 'leitthema' => 'Jenseits des Verstands', 'ort' => 'Marburg'],
    '2005' => ['url' => 'programmHistorie.php?y=2005', 'leitthema' => 'Sprache und Kommunikation', 'ort' => 'Darmstadt'],
    '2004' => ['url' => 'programmHistorie.php?y=2004', 'leitthema' => 'MACHT.WISSEN.SCHAFFT.SKEPSIS', 'ort' => 'Darmstadt'],
    '2003' => ['url' => 'programmHistorie.php?y=2003', 'leitthema' => 'Entscheidungen und Entscheider', 'ort' => 'Köln'],
    '2002' => ['url' => 'programmHistorie.php?y=2002', 'leitthema' => 'Netzwerke', 'ort' => 'Frankfurt']
];

Tpl::set('vergangeneMAs', $vergangeneMAs);

Tpl::render('historie');

Tpl::submit();
