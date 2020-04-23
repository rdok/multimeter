### Development

*Build development image*
```
docker build --tag multimeter:api  \
    --target infrastructure \
    --build-arg "UID=$(id -u)"  \
    --build-arg "GID=$(id -g)" \
    .
```
##### Commands
> `source aliases` *Loads temporary aliases for running following commands*
- `pipenv install` *Install packages from Pipfile.lock*
- `pipenv install a-package-name` *Installs package*
- `ptw` *Continuous test runner* 
- `pytest test_file.py` *Run a test* 


### TODO

- test
- linter
- PR lint & test
    - guard master branch
