#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#
# To edit the 'php-fpm' base Image, visit its repository on Github
#    https://github.com/LaraDock/php-fpm
#
# To change its version, see the available Tags on the Docker Hub:
#    https://hub.docker.com/r/laradock/php-fpm/tags/
#

FROM php:fpm-alpine

MAINTAINER Matthijs Dam <m.dam@samhoud.com>

# Install the PHP pdo_mysql extension
RUN docker-php-ext-install pdo_mysql

EXPOSE 9000