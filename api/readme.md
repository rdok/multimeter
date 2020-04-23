### Development
```
docker build --tag multimeter:api --build-arg "UID=$(id -u)"  \
    --build-arg "GID=$(id -g)" .

./python pipenv install flask
```
### TODO

- test
- linter
- PR lint & test
    - guard master branch
