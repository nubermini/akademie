<h1>Vortrags- und Workshop-Präferenzen</h1>

<p>Hier könnt ihr eure Präferenzen für das Vortragsprogramm der Mind-Akademie abgeben. Eine inhaltliche Beschreibung der Vorträge und Workshops kann unter Programm eingesehen werden. Im Folgenden kannst Du Dein Interesse für die verschiedenen Workshops und Vorträge eintragen.</p>

<p>Dieses Jahr erstellen wir den Programmplan auf Basis eurer Interessenlage, um so Kollisionen nach Möglichkeit zu vermeiden. Dabei gib deine Präferenz für eine Veranstaltung mit einer Zahl von 5 (Da muss ich hin) bis 0 (Jedes Gespräch auf der Akademie wird mir besser gefallen als diesr Vortrag/Workshop.)</p>

<form action="#">
	<h3>Vorträge</h3>
	<p>Bitte kennzeichnet alle Vorträge mit eurer Präfenz zwischen 5 (unbedingt) und 0 (Nie im Leben), an denen ihr gerne teilnehmen möchtet. Dies ist für die Zeit- und die Raumplanung wichtig.</p>
	<div class="accordion">
		<span data-do="show" class="button">Alle anzeigen</span>
		<span data-do="hide" class="button">Alle verbergen</span>

		<input type="checkbox" id="showBenecke" />
		<label for="showBenecke"><input type="number" min="0" max="5" name="benecke" />Lydia Benecke: Forensik</label>
		<div>*** weitere Informationen folgen ***</div>
		<input type="checkbox" id="showBorth" />
		<label for="showBorth"><input type="number" min="0" max="5" name="borth" />Dr. Damian Borth: Aktuelle Forschungsthemen im Bereich Deep Learning</label>
		<div>In diesem Vortrag erhält das Publikum einen Einblick in aktuelle Forschungsprojekte des Deep Learning Competence Center am Deutschen Forschungszentrum für künstliche Intelligenz.</div>
		<input type="checkbox" id="showBreitlauch" />
		<label for="showBreitlauch"><input type="number" min="0" max="5" name="breitlauch" />Prof. Dr. Linda Breitlauch: Game-Design</label>
		<div>*** weitere Informationen folgen ***</div>
		<input type="checkbox" id="showEmerich" />
		<label for="showEmerich"><input type="number" min="0" max="5" name="emmerich" />Dr. Maren Emmerich: Eine Reise zu den Wurzeln des Yoga</label>
		<div>Yoga ist ein Lebensstil, der aus fünf Elementen besteht: physische Übungen (Asanas), Atemübungen (Pranayama), vegetarische Ernährung, effektive Entspannung und Meditation. In meinem Vortrag möchte ich euch einen Einblick geben über die historischen und philosophischen Wurzeln des Yoga in Indien und über die vielen Richtungen, in die sich diese Tradition im Westen entwickelt hat.</div>
		<input type="checkbox" id="showEngler" />
		<label for="showEngler"><input type="number" min="0" max="5" name="engler" />Michael Engler: Wege von technischen Normen</label>
		<div>Wie entsteht eigentlich eine Norm wie die berühmte DIN A4? Wer hat eigentlich ein Interesse daran Normen zu etablieren? Der Prozess der Normung ist eine Form der Selbstregulierung der Industrie, wodurch Staat und die Politik entlastet werden. Daher ist dieses Thema nicht nur dröge und langweilig, sondern auch höchst spannend und eine höchst politische Angelegenheit. Es gilt nämlich in den meisten Gremien das Konsensprinzip. Der Vortrag beleuchtet anhand von Beispielen, wie Normen national und international entstehen, welche Organisationen die Normung vorantreiben und wer die maßgeblichen Spieler in der Normung sind. Zudem streift der Vortrag die Historie der Normung und gibt konkrete Hinweise zum Umgang mit Normen. Am Ende steht ein Fazit, was gut in der Normung funktioniert, wo die Normung an Grenzen stößt und warum es sinnvoll ist sich in der Normung zu engagieren.</div>
	</div>
	<h3>Teilnehmerdaten</h3>
	<fieldset>
		<label for="firstname">Vorname *</label>
		<input type="text" name="firstname" id="firstname" required="required" />
	</fieldset>
	<fieldset>
		<label for="lastname">Name *</label>
		<input type="text" name="lastname" id="lastname" required="required" />
	</fieldset>
	<fieldset>
		<label for="email">E-Mail-Adresse *</label>
		<input type="email" name="email" id="email" required="required" />
	</fieldset>
	<fieldset>
		<input type="submit" value="Formular absenden" />
	</fieldset>
</form>
<script type="text/javascript">
	var buttons = document.querySelectorAll('.accordion [data-do]');
	var accordionParts;

	Array.prototype.forEach.call(buttons, function(button, i){
		button.addEventListener('click', function() {
console.log(button);
			accordionParts = button.parentNode.children;
			Array.prototype.forEach.call(accordionParts, function(part, i){
console.log(part);
				if (part.tagName.toLowerCase() === "input" && part.type === "checkbox") {
					if (button.getAttribute('data-do') === "show") {
						part.checked = true;	
					} else {
						part.checked = false;	
					}
				}
			});
		});
	});
</script>

