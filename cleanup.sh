#!/bin/sh

# Delete all files older than 7 days in votes/

cd /home/web3ds8iu/html/wahl.avfrisia.de/votes
find . -mtime +6 -type f -delete
