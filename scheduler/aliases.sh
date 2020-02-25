
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

pt () {
  docker-run ./vendor/bin/phpunit "$@"
}

phpinsights () {
  docker run -it --rm -w /app -v "$(pwd)":/app nunomaduro/phpinsights \
    --min-quality=90 \
    --min-complexity=90 \
    --min-architecture=90 \
    --min-style=100 \
    "$@"
}
