<?php
namespace MHN\Akademie;

/**
 * Created by PhpStorm.
 * User: guido
 * Date: 04.08.17
 * Time: 21:57
 */

require_once '../lib/base.inc.php';

Tpl::set('navId', 'faq');

Tpl::set('toc', Tpl::getTableOfContents('faq'), false);

Tpl::render('faq');

Tpl::submit();
