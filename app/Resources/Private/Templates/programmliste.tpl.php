<?php
function makeUrlsClickable($html) {
    return preg_replace_callback('/https?:\/\/\S+|www\.\S+?\.\S+/', function ($matches) {
        $url = preg_match('/^https?:\/\//', $matches[0]) ? $matches[0] : ('https://' . $matches[0]);
        return '<a href="' . $url . '">' . $matches[0] . '</a>';
    }, $html);
}
?>
<?php if (isset($beitraege) && count($beitraege)): ?>
    <div id="programmliste">
<?php
    foreach ($beitraege as $b):
        $beitrag = new \MHN\Akademie\Beitrag($b);
        $start = $beitrag->get('programm_beginn');
        $namen = [];
        foreach ($beitrag->get('referenten') as $referent) {
            $namen[] = $referent['name'];
        }
?>
        <h3 class="programmtitel">
            <?=$beitrag->get('vTitel')?>
            <span class="vortragsform"><?=$beitrag->get('beitragsform')?></span>
        </h3>
        <div class="programmpunkt-info">
            <?php if ($start !== null): ?>
            <div class="zeit-und-ort">
                    <?=$start->format('d.m., H:i')?> Uhr, <?=$beitrag->get('programm_raum')?>
                </div>
            <?php endif; ?>
            <div class="name"><?=implode(', ', $namen)?></div>
        </div>
        <p><?=nl2br(makeUrlsClickable($beitrag->get('abstract')))?></p>

        <?php foreach ($beitrag->get('referenten') as $referent): if (trim($referent['kurzvita'])): ?>
            <h4 class="kurzvita-titel">Zu <?=$referent['name']?></h4>
            <p class="kurzvita"><?=nl2br(makeUrlsClickable($referent['kurzvita']))?></p>
        <?php endif; endforeach; ?>
<?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Das Programm wird zu gegebener Zeit hier veröffentlicht.</p>
<?php endif; ?>
