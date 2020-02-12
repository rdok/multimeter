FROM python:3.8-alpine3.11

RUN apk add --no-cache --virtual .build-deps \
		gcc \
		libc-dev \
		linux-headers \
	&& pip3 install --no-cache flask uwsgi \
	&& apk del .build-deps;

WORKDIR /db
COPY db/routes.py routes.py
CMD uwsgi --socket 0.0.0.0:8080 --wsgi-file /db/routes.py
