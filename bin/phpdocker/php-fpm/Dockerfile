FROM phpdockerio/php73-fpm:latest
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.4-mbstring  php7.4-xml php7.4-curl php7.4-memcached php7.4-mysql php7.4-redis php7.4-sqlite3 php7.4-xdebug php7.4-phpdbg \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=composer:2.0.12 /usr/bin/composer /usr/bin/composer