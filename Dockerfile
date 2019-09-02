FROM 1and1internet/ubuntu-16-apache-php-7.2

MAINTAINER alan.ting@104

# install phpredis function
RUN apt-get update && \
    apt-get install -y software-properties-common

EXPOSE 85

WORKDIR /var/www/html/public
