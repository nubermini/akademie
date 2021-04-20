<?php
declare(strict_types=1);
namespace MHN\Akademie;

require_once '../lib/base.inc.php';

Tpl::set('navId', 'symposium');

Tpl::render('Symposium/symposium');

Tpl::submit();
