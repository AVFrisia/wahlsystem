# votes

Hier werden die Stimmen gespeichert.

## Format

Die Stimmen werden als JSON kodiert und auf dem Server abgelegt.

```json
{
    "pin": "1234",
    "description": "Besipiel Benotung",
    "type": "grade",
    "votes": [
        {
            "time": 1617811420,
            "ip": "::1",
            "session-id": "",
            "contents": "3"
        },
        {
            "time": 1617811434,
            "ip": "::1",
            "session-id": "",
            "contents": "1"
        }
    ]
}
