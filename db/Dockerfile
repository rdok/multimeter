FROM python:3.8-alpine3.11

RUN apk update && apk add --no-cache --virtual .build-deps \
		gcc libc-dev linux-headers \
		sqlite \
	&& pip3 install --no-cache \
	    flask uwsgi \
	    flask-wtf wtforms_json \
	    flask-sqlalchemy flask-migrate \
	&& apk del .build-deps;

WORKDIR /db
COPY db .

ENV FLASK_APP=/db/db.py
