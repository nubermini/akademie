<?php
namespace MHN\Akademie;

/**
 * Created by PhpStorm.
 * User: guido
 * Date: 04.08.17
 * Time: 21:57
 */

require_once '../lib/base.inc.php';

Tpl::set('navId', 'praeferenzen');

Tpl::render('praeferenzen');

Tpl::submit();
