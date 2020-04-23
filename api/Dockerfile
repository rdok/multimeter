FROM python:3.8-alpine3.11

ENV USER=api
ARG UID=2000
ARG GID=3000

RUN addgroup -S -g $GID "${USER}" \
    && adduser -S  -D -h "/${USER}" -u $UID -G "${USER}" "${USER}"

USER "${USER}"

ENV PATH="/api/.local/bin:${PATH}"
ENV PIPENV_VENV_IN_PROJECT=1
RUN pip install --upgrade --no-cache pipenv

WORKDIR "/${USER}/src"
COPY . .
