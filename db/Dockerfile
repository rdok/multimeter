FROM python:3.8-alpine3.11

RUN apk update && apk add --no-cache --virtual .build-deps \
		gcc libc-dev linux-headers sqlite \
	&& pip3 install --no-cache uwsgi pipenv \
	&& apk del .build-deps;

ARG DB_UID=2077
ARG DB_GID=2078

RUN addgroup -g ${DB_GID} -S db-group \
    && adduser -u ${DB_UID} -S db-user -G db-group

COPY --chown=db-user:db-group entrypoint.sh /home/db-user/entrypoint.sh
RUN chmod +x /home/db-user/entrypoint.sh
ENTRYPOINT ['/home/db-user/entrypoint.sh']

USER db-user
ENV FLASK_APP=/home/db-user/src/db.py
WORKDIR /home/db-user/app
COPY --chown=db-user:db-group Pipfile Pipfile.lock ./
RUN pipenv install

COPY --chown=db-user:db-group . .
