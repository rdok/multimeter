FROM python:3.8-alpine3.11

RUN apk add --no-cache --virtual .build-deps \
		gcc \
		libc-dev \
		linux-headers \
	&& pip3 install --no-cache flask uwsgi requests \
	&& apk del .build-deps;

WORKDIR /api
COPY api/routes.py routes.py
