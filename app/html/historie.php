<?php
namespace MHN\Akademie;

require_once '../lib/base.inc.php';

Tpl::set('navId', 'historie');

Tpl::render('historie');

Tpl::submit();
