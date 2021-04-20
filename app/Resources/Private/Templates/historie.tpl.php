<h1>Vergangene Mind-Akademien</h1>

<?php if (isset($vergangeneMAs)): ?>

    <table class="historie">
        <tr>
            <th>Jahr</th>
            <th>Leitthema</th>
            <th>Ort</th>
        </tr>
        <?php

        foreach ($vergangeneMAs as $year => $daten) {
            if (!$daten) {
                continue;
            }

            $leitthema = ($daten['url'] != '#') ? "<a href=" . $daten['url'] . ">" . $daten['leitthema'] . "</a>" : $daten['leitthema'];

            echo "<tr><td>". $year . "</td><td>" . $leitthema ."</td><td>" . $daten['ort'] . "</td></tr>\n";
        }

        ?>
    </table>

<?php endif; ?>
