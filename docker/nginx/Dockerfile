FROM nginx:1.17-alpine

COPY docker/nginx/app.conf /etc/nginx/conf.d/default.conf
COPY . /usr/share/nginx/html

COPY ./docker/wait-for /wait-for
RUN chmod +x /wait-for
CMD /wait-for uwsgi:8080 -- nginx -g 'daemon off;'


