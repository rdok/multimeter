#!/bin/bash

function docker-compose-dev() {
  docker-compose -f docker-compose.yml -f docker-compose.dev.yml "$@"
}
