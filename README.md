# Mind-Akademie

Die MA-Webseite (www.mind-akademie.de)

## Container lokal bauen und starten

    $ make image
    $ make dev

Die Seite ist dann im Browser unter [https://akademie.docker.localhost/](https://akademie.docker.localhost/) erreichbar. Die Sicherheitswarnung wegen des Zertifikates kann weggeklickt werden.

### Schnittstelle zum Referententool

Wenn das Referententool ebenfalls läuft, wird der Programmplan von dort geladen. Dazu muss das Referententool im selben Netzwerk sein.
