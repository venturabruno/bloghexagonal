FROM ubuntu:latest
RUN apt-get update \ 
	&& apt-get install locales -y \ 
	&& locale-gen en_US.UTF-8 \ 
	&& export LANG=en_US.UTF-8 \ 
	&& apt-get install -y software-properties-common \ 
	&& apt-get install -y language-pack-en-base \ 
	&& LC_ALL=en_US.UTF-8 add-apt-repository -y ppa:ondrej/php \
	&& apt-get update -y
RUN apt-get install tzdata
RUN echo "America/Sao_Paulo" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata
RUN apt-get install -y \
	php7.2 php-pear \
	php7.2-curl \
	php7.2-dev \
	php7.2-gd \
	php7.2-mbstring \
	php7.2-zip \
	php7.2-mysql \
	php7.2-xml \
	php7.2-cli \
	libapache2-mod-php7.2 \
	php7.2-mysql \
	php-memcached \
	php7.2-sqlite3 \
	php7.2-json \
	php-xdebug 
RUN apt-get install php7.2-redis
RUN pecl install apcu
RUN	apt-get install -y npm nodejs apache2 libapache2-mod-php7.2 argon2 libargon2-0
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod headers \
	&& a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data 
ENV APACHE_LOG_DIR /var/log/apache2 
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2 
RUN mkdir -p $APACHE_RUN_DIR $APACHE_LOCK_DIR $APACHE_LOG_DIR
VOLUME [ "/var/www/html" ]
WORKDIR /var/www/html
EXPOSE 80
ENTRYPOINT [ "/usr/sbin/apache2" ]
CMD ["-D", "FOREGROUND"]
