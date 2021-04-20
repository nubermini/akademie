<?php
declare(strict_types=1);

namespace MHN\Akademie;

// fest kodiert, kein sichererer Schutz erforderlich, darf auch auf github zu sehen sein, salt: )8cWa*
const PASSWORD_HASH = '65068a59c812678e84d8349e28d546d864009f566eb6f10a55c2e1ac59c96647';

require_once '../lib/base.inc.php';

ensure($_POST['password'], ENSURE_STRING);

if (hash('sha256', ')8cWa*' . $_POST['password']) !== PASSWORD_HASH) {
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
