# wahlsystem

[![Lint Code Base](https://github.com/AV-Frisia/wahlsystem/actions/workflows/linter.yml/badge.svg)](https://github.com/AV-Frisia/wahlsystem/actions/workflows/linter.yml)

Anonymes, datenbankloses Stimmabgabesystem

## Sicherheit

### HTTPS

Es ist empfohlen, dass HTTPS benutzt wird, damit Wahldaten sowie PINs nur zwischen Wähler und Server sichtbar sind.

### Directory Listings

Damit PINs und Wahldaten geheim bleiben, ist es kritisch Zugang zum Ordner `votes` zu verhindern. Dies wird bei Apache-Servern automatisch durch die `.htaccess` Datei in diesem Repo eingestellt.
