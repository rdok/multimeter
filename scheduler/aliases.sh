
docker-run () {
  docker run --rm -it -v "${PWD}:/app" -w /app -u "${UID}" \
    multimeter/scheduler-dev "$@"
}

composer () {
  docker run --rm -it -v "${PWD}:/app" -w /app -u "${UID}" \
    composer "$@"
}

console () {
  docker-run php console "$@"
}

t () {
  docker-run ./vendor/bin/phpunit "$@"
}
