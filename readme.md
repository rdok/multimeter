### Multimeter

![Initial setup](logo.jpg "Initial Setup")

```bash
source aliases.sh
docker-compose up -d
python3 src/entry.py hello 5
```

### Build, Tag, Push
```
docker-compose build
docker tag multimeter_dht22 rdok/multimeter
docker push rdok/multimeter
```

### TODO.ci
```
docker image pull rdok/multimeter
docker run --privileged=true --rm -t rdok/multimeter python3 /app/dht_checkup.py

docker-compose build
docker-compose run --rm -u "${UID}" python3 src/dht_checkup.py
docker run --rm -it --privileged multimeter_python3 python3 src/dht_checkup.py
docker service create --name falcon9 --constraint node.labels.name==falcon9 multimeter_python3
docker service create --constraint node.labels.name==falcon9 alpine ping 8.8.8.8
```

