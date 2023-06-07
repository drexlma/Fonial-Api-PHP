# Fonial-Api-PHP
PHP Klasse um über die Api auf die Informationen bei Fonial zuzugreifen

Es gibt eine Beispiel-PHP-Datei die zeigt wie die Datei aufzurufen ist.

https://www.fonial.de/hilfe/api

Der Codeausschnitt zeigt, wie die Fonial-Klasse verwendet wird, um verschiedene API-Endpunkte aufzurufen und die Ergebnisse zu erhalten. Hier ist eine Beschreibung jedes Abschnitts:

Zuerst wird die Datei fonial.class.php mit require() eingebunden, um die Fonial-Klasse verfügbar zu machen.

- Eine Instanz der Fonial-Klasse wird mit dem Namen $Fonial erstellt.
- Die Methode deviceGet() der Fonial-Klasse wird aufgerufen, um eine Liste der Geräte abzurufen. Das Ergebnis wird mit print_r() ausgegeben.
- Die Methode numbersGet() der Fonial-Klasse wird aufgerufen, um eine Liste der Nummern abzurufen. Das Ergebnis wird mit print_r() ausgegeben.
- Die Methode evnGet() der Fonial-Klasse wird aufgerufen, um Einzelverbindungsnachweise abzurufen. Dabei werden zwei Parameter übergeben: das Startdatum (5 Tage vor dem aktuellen Zeitpunkt) und das Enddatum (aktuelles Zeitpunkt). Das Ergebnis wird mit print_r() ausgegeben.

