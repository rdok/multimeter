FROM python:3.8-slim-buster

RUN apt-get update \
    && apt-get install -y \
        gcc libgpiod2 libc-dev \
    && rm -rf /var/lib/apt/lists/*

RUN pip3 install --upgrade --no-cache-dir \
        setuptools \
        adafruit-blinka adafruit-circuitpython-dht \
        rpi.gpio \
	    flask uwsgi

WORKDIR /dht22
COPY dht22/routes.py routes.py
CMD uwsgi --socket 0.0.0.0:8090 --wsgi-file /dht22/routes.py
