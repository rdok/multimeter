FROM nginx:1.17-alpine

COPY web/wait-for /wait-for
RUN chmod +x /wait-for

COPY web/nginx.conf /etc/nginx/conf.d/default.conf
COPY web/public /usr/share/nginx/html
