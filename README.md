# Technoblog

## Überblick

Technoblog ist eine moderne Plattform für Technologie-News, Programmier-Tutorials und Hardware-Insights, präsentiert in einem einzigartigen Vaporwave-Design. Benutzer können Artikel lesen, kommentieren und sich mit der Community austauschen.

## Funktionen

- **Artikelverwaltung**: Anzeigen und Lesen von Technologie- und Programmier-Artikeln.
- **Kategorien**: Filterung von Artikeln nach Hardware oder Gaming.
- **Kommentare**: Benutzer können Artikel kommentieren und ihre Meinungen austauschen.
- **Community-Seite**: Anzeige aller Kommentare mit Verlinkung zu den Artikeln.
- **Benutzersystem**:
  - Registrierung und Anmeldung mit passwortgeschützten Accounts.
  - Automatischer Login durch Cookies.
- **Hervorgehobene Inhalte**: "Trending" und "Must-Read" Artikel auf der Hauptseite.

## Installation

### Voraussetzungen

- **PHP 8.x**
- **MySQL-Datenbank**
- **Apache oder ein lokaler Server (XAMPP, WAMP)**

### Datenbank einrichten

1. Importiere die `technoblog.sql` Datei in MySQL.
2. Stelle sicher, dass die Verbindung in `includes/db.php` korrekt konfiguriert ist.

### Projekt einrichten

1. Kopiere die Dateien in das Webserver-Verzeichnis.
2. Stelle sicher, dass `mod_rewrite` in Apache aktiviert ist.
3. Passe ggf. `config.php` für individuelle Einstellungen an.

### Starten

Rufe die Webseite im Browser unter `http://localhost/Technoblog` auf.

## Nutzung

- **Artikel lesen**: Einfach auf einen Artikel klicken.
- **Kommentare schreiben**: Nach Anmeldung unterhalb eines Artikels.
- **Artikel filtern**: Magazine-Seite nutzen und nach Kategorien sortieren.
- **Anmelden/Registrieren**: Zugang zu erweiterten Funktionen erhalten.

## Sicherheit

- **Passwörter**: Speicherung als gehashte Werte (bcrypt).
- **CSRF-Schutz**: Eingeschränkte Formularnutzung für authentifizierte Nutzer.
- **Prepared Statements**: Schutz vor SQL-Injection.

## Weiterentwicklung

- Verbesserung des Designs und der Benutzererfahrung.
- Integration von API-Schnittstellen für externe Inhalte.
- Erweiterung des Community-Features mit Upvotes und Erwähnungen.

## Lizenz

Dieses Projekt steht unter der **MIT-Lizenz**. Die Nutzung und Modifikation ist frei erlaubt, solange die ursprüngliche Lizenz erhalten bleibt.
