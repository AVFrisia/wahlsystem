# wahlsystem

[![Lint Code Base](https://github.com/AV-Frisia/wahlsystem/actions/workflows/linter.yml/badge.svg)](https://github.com/AV-Frisia/wahlsystem/actions/workflows/linter.yml) [![Docker Image CI](https://github.com/AV-Frisia/wahlsystem/actions/workflows/docker-image.yml/badge.svg)](https://github.com/AV-Frisia/wahlsystem/actions/workflows/docker-image.yml)

Anonymes, datenbankloses Stimmabgabesystem

## Installation

Erfordert nur ein Server mit mindestens PHP 8. Alle Dateien in dieser Repository können direkt in den Wurzelordner abgelegt werden.

## Sicherheit

### HTTPS

Es ist imperativ, dass HTTPS benutzt wird, damit Wahldaten sowie PINs nur zwischen Wähler und Server sichtbar sind.

### Speicherung der Wahldateien

Wahldateien werden im von PHP designierten temporären Verzeichnis gespeichert. Unter Unixoiden Systemen wird die Datei auch mit `0600`-Berechtigungen versehen um vor Zugriff Anderer zu schützen.

## Format

```json
{
    "pin": "0520",
    "description": "Entlastung des Fuxmajors",
    "type": "grade",
    "votes": [
        {
            "time": 1618270119,
            "ip": "192.168.1.128",
            "session-id": "8O3Bjrnr50fzly3Vc0ifku2wuMYnuM8w",
            "contents": 2
        }
        {
            "time": 1618270123,
            "ip": "192.168.1.69",
            "session-id": "TqCPomTL7mI0XSGyxBhLrdVKbWYgh04a",
            "contents": 1
        }
    ]
}
```

*Beispiel: 2 eingegangene Stimmen zur Entlastung des Fuxmajors*
