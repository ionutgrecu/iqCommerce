FROM alpine:3.12
LABEL Maintainer="Ionut Grecu <ionut@grecu.eu>" \
      Description="Lightweight container with Nginx 1.18 & PHP-FPM 7.3 based on Alpine Linux. Fork from https://hub.docker.com/r/trafex/alpine-nginx-php7/dockerfile and inspired from https://hub.docker.com/r/lorisleiva/laravel-docker/dockerfile"

# Install packages and remove default server definitionzip
RUN apk --no-cache add openssl util-linux php7 php7-fpm php7-opcache php7-mysqli php7-json php7-memcached php7-openssl php7-common php7-curl php-pdo php-pdo_mysql \
    php7-zlib php7-xml php7-phar php7-intl php7-dom php7-xmlreader php7-ctype php7-session php7-zip php7-bcmath \
    php7-mbstring php7-gd php7-calendar php7-exif php7-iconv php7-pcntl php7-tokenizer php7-fileinfo \
    nginx composer yarn git supervisor curl nano sudo && \
    rm /etc/nginx/conf.d/default.conf

RUN apk add --update busybox-suid
RUN apk add wkhtmltopdf xvfb

# Configure nginx
COPY config/nginx.conf /etc/nginx/nginx.conf
RUN chmod 0755 /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY config/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
RUN chmod 0755 /etc/php7/php-fpm.d/www.conf
COPY config/php.ini /etc/php7/conf.d/custom.ini
RUN chmod 0755 /etc/php7/conf.d/custom.ini
COPY config/20-opcache.ini  /etc/php7/conf.d/20-opcache.ini
RUN chmod 0755 /etc/php7/conf.d/20-opcache.ini

# Configure supervisord
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN chmod 0755 /etc/supervisor/conf.d/supervisord.conf

COPY config/init.sh /init.sh
RUN chmod 0755 /init.sh

# Setup document root
RUN mkdir -p /var/www/html/public

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /var/www/html && \
  chown -R nobody.nobody /run && \
  chown -R nobody.nobody /var/lib/nginx && \
  chown -R nobody.nobody /var/log/nginx

# Switch to use a non-root user from here on
USER nobody

# Add application
WORKDIR /var/www/html/public
COPY --chown=nobody src/ /var/www/html/

# Expose the port nginx is reachable on
EXPOSE 8080

CMD ["/bin/sh", "-c", "/init.sh"]
#CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
