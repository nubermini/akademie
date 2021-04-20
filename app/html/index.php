<?php
declare(strict_types=1);
namespace MHN\Akademie;

require_once '../lib/base.inc.php';

Tpl::set('navId', 'home');

Tpl::render('Home/home');

Tpl::submit();
