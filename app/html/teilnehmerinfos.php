<?php
declare(strict_types=1);

namespace MHN\Akademie;

require_once '../lib/base.inc.php';

ensure($_POST['password'], ENSURE_STRING);

if ($_POST['password'] !== getenv('TEILNEHMERINFOS_PASSWORD')) {
    if ($_POST['password']) {
        Tpl::set('wrongPassword', true);
    }
    Tpl::render('Teilnehmerinfos/form');
    Tpl::submit();
    exit;
}

Tpl::set('toc', Tpl::getTableOfContents('Teilnehmerinfos/infos'), false);

Tpl::render('Teilnehmerinfos/infos');

Tpl::submit();
