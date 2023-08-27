FROM php:8.1-fpm

ENV PHP_MEMORY_LIMIT=512M

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libxml2-dev libgd-dev libldap2-dev npm \
    #&& apt install -y wkhtmltopdf=0.12.6-1 xvfb \
	&& apt install -y wget \
    && apt install -y zlib1g-dev libpng-dev libjpeg-dev \
    && docker-php-ext-install intl opcache pdo pdo_mysql soap gd ldap \
    && pecl install apcu \
    && npm install file-loader \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get install -y libmagickwand-dev --no-install-recommends  \
    && rm -rf /var/lib/apt/lists/* \
    && pecl install imagick \
    && docker-php-ext-enable imagick

RUN apt-get -y update && apt-get -y upgrade
RUN apt-get install -y cron

RUN npm i -g corepack
RUN npm i -g n
RUN n 14

# Copy cron file to the cron.d directory on container
COPY cron /etc/cron.d/cron

# Give execution access
RUN chmod 0644 /etc/cron.d/cron

# Run cron job on cron file
RUN crontab /etc/cron.d/cron

# Create the log file
RUN touch /var/log/cron.log

#CMD cron

# SHELL ["/bin/bash", "-o", "pipefail", "-c"]
RUN #arch=$(arch | sed s/aarch64/arm64/ | sed s/x86_64/amd64/) && \
#    wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.buster_${arch}.deb
RUN #arch=$(arch | sed s/aarch64/arm64/ | sed s/x86_64/amd64/) && \
#    apt -y install ./wkhtmltox_0.12.6-1.buster_${arch}.deb
RUN apt -y install xvfb

WORKDIR /var/www/dogomaniacy

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN curl -LO https://deployer.org/deployer.phar
RUN mv deployer.phar /usr/local/bin/dep
RUN chmod +x /usr/local/bin/dep

RUN apt-get install -y supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
#CMD ["/usr/bin/supervisord"]
