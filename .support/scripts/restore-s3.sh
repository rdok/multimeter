#!/bin/bash

# ./restore.sh FreshInstall_02-Feb-20.img.gz /dev/sdb

test -z "${1}" && echo '1st argument requires backup file.' && exit
test -z "${2}" && echo '2nd argument requires mount.' && exit

sudo echo 'Sudo enabled.'

NAME="${1}"
MOUNT="${2}"

aws s3 cp --profile falcon9 "s3://backups-rdok/falcon9/${NAME}" - | \
  zcat | \
  sudo dd bs=4M of="${MOUNT}" status=progress
