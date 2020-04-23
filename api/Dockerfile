FROM python:3.8-alpine3.11 as infrastructure

ENV USER=api
ARG UID=2000
ARG GID=3000
RUN addgroup -S -g $GID $USER \
    && adduser -S  -D -h /$USER -u $UID -G $USER $USER
USER $USER

ENV PATH="/api/.local/bin:${PATH}"
ENV PIPENV_VENV_IN_PROJECT=1
RUN pip install --upgrade --no-cache pipenv

FROM infrastructure
RUN mkdir "/${USER}/src"
WORKDIR "/${USER}/src"
COPY --chown=$UID:$GID Pipfile .
COPY --chown=$UID:$GID Pipfile.lock .
RUN pipenv install
COPY --chown=$UID:$GID . .
