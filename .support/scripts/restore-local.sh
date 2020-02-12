#!/bin/bash

# ./restore-local.sh FreshInstall /dev/sdb

test -z "${1}" && echo '1st argument requires source, e.g. FreshInstall' && exit
test -z "${2}" && echo '2nd argument requires target.' && exit
sudo echo 'Sudo available.'

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
SOURCE="${1}.img.gz"
TARGET="${2}"

zcat "${DIR}/../storage/backups/${SOURCE}" | \
  sudo dd bs=4M of="${TARGET}" status=progress
