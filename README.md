# Mind-Akademie

Die MA-Webseite (www.mind-akademie.de)

## Starten

[php-base](https://github.com/Mind-Hochschul-Netzwerk/php-base) muss bereits gebaut sein.

### Target "dev" (Entwicklung)

    $ composer install -d app
    $ make rebuild
    $ make dev

Die Seite ist dann im Browser unter [https://akademie.docker.localhost/](https://akademie.docker.localhost/) erreichbar. Die Sicherheitswarnung wegen des Zertifikates kann weggeklickt werden.

* Benutzername: Webteam
* Passwort: webteam1

### Target "prod" (Production)

    $ make prod

### Schnittstelle zum Referententool

Wenn das Referententool ebenfalls läuft, wird der Programmplan von dort geladen. Dazu muss das Referententool im selben Netzwerk sein.
