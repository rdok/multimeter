FROM nginx:1.17-alpine

#ARG UID
#ARG GID
#RUN set -x ; \
#    addgroup -g "${GID}" -S www-data ; \
#    adduser -u "${UID}" -D -S -G www-data www-data && exit 0 ; exit 1

COPY ./docker/wait-for /wait-for
RUN chmod +x /wait-for
CMD /wait-for uwsgi:8080 -- nginx -g 'daemon off;'

COPY docker/nginx/app.conf /etc/nginx/conf.d/default.conf
COPY web /usr/share/nginx/html
#COPY --chown=www-data:www-data web /usr/share/nginx/html
#USER www-data
