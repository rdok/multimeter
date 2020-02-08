### Multimeter

![Initial setup](logo.jpg "Initial Setup")

```bash
source aliases.sh
docker-compose up -d
python3 src/entry.py hello 5
```

### TODO.ci
```
docker-compose build
docker service create --name falcon9 --constraint node.labels.name==falcon9 multimeter_python3

docker service create --constraint node.labels.name==falcon9 alpine ping 8.8.8.8
```

