<h1>Informationen für Teilnehmer(innen)</h1>

<?php if (!empty($wrongPassword)): ?>
    <div class="error">Das eingegebene Kennwort ist nicht korrekt. Bitte überprüfe auch die Groß- und Kleinschreibung.</div>
<?php endif; ?>

<p>Für den Zugang ist ein Kenntwort erforderlich, dass dir mit der Anmeldebestätigung zugeschickt wurde.</p>

<form action="" method="post">
    <label for="password">Zugangskennwort für Teilnehmer(innen):</label>
    <input type="password" name="password" id="password"></input>
    <button>Absenden</button>
</form>
