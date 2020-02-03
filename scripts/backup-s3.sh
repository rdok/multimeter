#!/bin/bash

# ./backup.sh FreshInstall /dev/sdb

test -z "${1}" && echo '1st argument requires source, e.g. /dev/sdb.' && exit

SOURCE="${1}"
NAME=$([ -z "$2" ] && date +%F_%H-%M || echo "$2")
NAME="${NAME}.img.gz"

sudo dd bs=4M if="${SOURCE}" status=progress |
  gzip |
  aws s3 cp \
      --storage-class DEEP_ARCHIVE \
      --profile falcon9 \
      --expected-size=$((1024 * 1024 * 1024 * 35)) \
    - \
    "s3://backups-rdok/falcon9/${NAME}"
