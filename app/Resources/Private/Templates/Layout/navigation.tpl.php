<?php
namespace MHN\Akademie;

    $navItems = [
        'homepage' => ['/', 'Überblick', 'home'],
        'programm' => ['programm.php', 'Programm', 'calendar'],
//  Für die MA 2017 nicht relevant, da kein Programm vorhanden.
//        'rahmenprogramm' => ['rahmenprogramm.php', 'Rahmenprogramm', 'calendar'],
        'faq' => ['faq.php', 'Häufige Fragen', 'plus'],
        'historie' => ['historie.php', 'Vergangene Akademien', 'calendar'],
        'symposium' => ['symposium.php', 'Symposium', 'calendar',
            [
                'symposium_programm' => ['symposium_programm.php', 'Programm', 'calendar'],
                'symposium_historie' => ['symposium_historie.php', 'Vergangene Symposien', 'calendar']
            ]],
        'moodle' => ['https://www.' . getenv('DOMAINNAME'), 'Mind-Hochschul-Netzwerk', 'home'],
        'datenschutz' => ['https://www.' . getenv('DOMAINNAME') . '/mod/book/view.php?id=253&chapterid=4', 'Datenschutz', 'paragraph'],
        'impressum' => ['https://www.' . getenv('DOMAINNAME') . '/mod/book/view.php?id=253&chapterid=5', 'Impressum', 'globe'],
    ];

?>
<div class="content">
    <input type="checkbox" id="showMenu" /> <label for="showMenu" class="button"></label>
    <ul class="navigation">
        <?php

        foreach ($navItems as $itemname => $item) {
            if (!$item) {
                continue;
            }

            echoListItem($itemname, $item, $navId ?? null);
        }

        function echoListItem($name, $item, $navId)
        {
            if (!isset($item[3])) {
                $item[3] = [];
            }

            $submenuIsOpen = ($navId === $name);

            foreach ($item[3] as $subitemName => $subitem) {
                if ($navId === $subitemName) {
                    $submenuIsOpen = true;
                }
            }

            $class = ($navId === $name) ? 'active' : '';
            echo "<li class='$class'><a href='$item[0]'>$item[1]<span class='pull-right showopacity glyphicon glyphicon-$item[2]'></span></a>\n";

            if ($item[3]) {
                echo "    <ul class='submenu" . ($submenuIsOpen ? ' open' : '') . "'>";

                foreach ($item[3] as $subitemname=>$subitem) {
                    $class = ($navId === $subitemname) ? 'active' : '';
                    echo "        <li class='$class'><a href='$subitem[0]'>$subitem[1]<span class='pull-right showopacity glyphicon glyphicon-$subitem[2]'></span></a></li>\n";
                }
                echo "    </ul>\n";
            }

            echo "</li>\n";
        }

        ?>
    </ul>
    <a href="/" class="header">
        <img src="/img/logo.png" alt="" />
        <h1>Mind-Akademie 2021</h1>
        <h2>Wandel</h2>
    </a>
    <div class="main">

