### Development
```
docker build --tag multimeter:api  \
    --target infrastructure \
    --build-arg "UID=$(id -u)"  \
    --build-arg "GID=$(id -g)" \
    .

./python pipenv install
```
### TODO

- test
- linter
- PR lint & test
    - guard master branch
