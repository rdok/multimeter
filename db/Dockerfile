FROM python:3.8-alpine3.11

RUN apk update && apk add --no-cache --virtual .build-deps \
		gcc libc-dev linux-headers \
		sqlite \
	&& pip3 install --no-cache --upgrade \
	    uwsgi flask \
	    flask-wtf wtforms_json \
	    flask-sqlalchemy flask-migrate \
	&& apk del .build-deps;

COPY /db/docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]

ENV FLASK_APP=/db/db.py
WORKDIR /db
COPY db .
