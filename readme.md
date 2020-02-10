### Multimeter

![Initial setup](logo.jpg "Initial Setup")

```bash
source aliases.sh
docker-compose up -d
python3 src/entry.py hello 5
```

### TODO.ci
```
docker image pull rdok/multimeter:dht22
docker image pull rdok/multimeter:uwsgi
docker image pull rdok/multimeter:nginx

docker run --privileged=true --rm -t rdok/multimeter:dht22  python3 /app/dht_checkup.py
docker run --rm -t rdok/multimeter:uwsgi 
docker run --rm -t rdok/multimeter:nginx 
```

