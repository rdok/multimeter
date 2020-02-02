#!/bin/bash

NAME=$([ -z "$1" ] && date +%F_%H-%M || echo "$1" )
NAME="${NAME}.img.gz"

sudo dd bs=4M if=/dev/sdb status=progress \
   | gzip \
   | aws s3 cp --storage-class DEEP_ARCHIVE --profile falcon9 - \
      "s3://backups-rdok/falcon9/${NAME}"
