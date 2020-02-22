FROM python:3.8-slim-buster

RUN apt-get update \
    && apt-get install -y \
        gcc libgpiod2 libc-dev \
        procps \
    && rm -rf /var/lib/apt/lists/*

RUN pip3 install --upgrade --no-cache-dir \
        setuptools \
        adafruit-blinka adafruit-circuitpython-dht \
        rpi.gpio \
	    flask uwsgi \
	    psutil

WORKDIR /dht22
COPY dht22 .
