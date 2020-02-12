#!/bin/bash

# ./backup.sh /dev/sdb ...FreshInstall

test -z "${1}" && echo '1st argument requires src, e.g. /dev/sdb.' && exit

NAME=$([ -z "$2" ] && echo "master" || echo "$2")
NAME="${NAME}.img.gz"
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

sudo dd bs=4M if=/dev/sdb status=progress | \
  gzip > "${DIR}/../storage/backups/${NAME}"
