FROM ubuntu:16.04
USER root

ARG PASSWORD=root

WORKDIR /var/www

#Install basic environment
RUN apt-get -y update && \
	apt-get -y install \ 
	software-properties-common \
	python-software-properties \
    openssh-server \
	supervisor \
    nano \
    git \
    vim 

RUN	LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php

RUN apt-get -y update

RUN DEBIAN_FRONTEND=noninteractive apt-get -y install mysql-server 

#Server
RUN apt-get install -y \
	redis-server \
	apache2 \
	wget \
	curl \
	php7.2 \
	php7.2-cli \
	php7.2-common \
	libapache2-mod-php7.2 \
	php7.2-gd \
	php7.2-json \
	php7.2-ldap \
	php7.2-mbstring \
	php7.2-mysql \
	php7.2-opcache \
	php7.2-curl \
	php7.2-xml \
	php7.2-xsl \
	php7.2-zip \
	php7.2-redis \
	php7.2-xdebug \
	composer

#Install Updated Node
RUN curl -sL https://deb.nodesource.com/setup_9.x | bash -
RUN apt-get install -y nodejs

#Set up SSH access
RUN mkdir /var/run/sshd
RUN sed -i.bak s/PermitRootLogin\ prohibit-password/PermitRootLogin\ yes/g  /etc/ssh/sshd_config
RUN echo "root:$PASSWORD" | chpasswd

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY vhosts.conf /etc/apache2/sites-available/000-default.conf
COPY redis.conf /etc/redis/redis.conf
RUN sed -Ei 's/^(bind-address|log)/#&/' /etc/mysql/mysql.conf.d/mysqld.cnf
RUN a2enmod rewrite
RUN a2enmod headers

RUN composer global require "laravel/installer"

EXPOSE 22 80 3306

CMD ["/usr/bin/supervisord"]

VOLUME ["/var/lib/mysql", "/var/log/mysql", "/var/log/apache2"]
