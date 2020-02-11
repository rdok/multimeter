### Multimeter

[![Build Status](https://jenkins.rdok.dev/buildStatus/icon?job=multimeter%2Fdeploy)](https://jenkins.rdok.dev/job/multimeter/job/deploy/)

![Initial setup](logo.jpg "Initial Setup")

```bash
source aliases.sh
docker-compose-dev up -d
python3 src/entry.py hello 5
```

### TODO.ci
```
docker run --privileged=true --rm -t rdok/multimeter:dht22  python3 /app/dht_checkup.py
```

