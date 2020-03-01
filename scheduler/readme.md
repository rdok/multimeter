### Scheduler
Responsible for getting data from dht22 service, and post said data
to the db service, every minute.

Uses symfony command: `./bin/console dht22:temperature`

### Development

```shell script
./bin/console
./bin/phpunit
./bin/phpinsights
./bin/composer
```