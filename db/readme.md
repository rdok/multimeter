# DB
Maintains measurements data set. Services met fetch & store data through RESTful API.

# Development
```shell script
docker build \
  --build-arg DB_GID="$(id -g)" \
  --build-arg DB_UID="$(id -u)" \
  --tag multimeter_db:dev \
  .

./bin/pipenv install
```