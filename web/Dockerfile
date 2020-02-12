FROM nginx:1.17-alpine

COPY web/wait-for /wait-for
RUN chmod +x /wait-for
CMD /wait-for db:8080 -- /wait-for dht22:8090 -- nginx -g 'daemon off;'

COPY web/nginx.conf /etc/nginx/conf.d/default.conf
COPY web/public /usr/share/nginx/html
