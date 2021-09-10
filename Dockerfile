FROM php:8.0-apache

RUN set -ex ; \
    docker-php-ext-install ctype iconv ;

RUN echo "<VirtualHost *:80> \n\
              DocumentRoot /var/www/html/public \n\
              DirectoryIndex /index.php \n\
              <Directory /var/www/html/public> \n\
                  AllowOverride None \n\
                  Order Allow,Deny \n\
                  Allow from All \n\
                  FallbackResource /index.php \n\
              </Directory> \n\
              <Directory /var/www/project> \n\
                   Options FollowSymlinks \n\
              </Directory> \n\
              <Directory /var/www/project/public/bundles> \n\
                  DirectoryIndex disabled \n\
                  FallbackResource disabled \n\
              </Directory> \n\
              ErrorLog /dev/stderr \n\
              CustomLog /dev/stdout combined \n\
              SetEnv APP_ENV prod \n\
          </VirtualHost>" > /etc/apache2/sites-available/000-default.conf


RUN set -ex ; \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" ; \
    php composer-setup.php ; \
    php -r "unlink('composer-setup.php');" ; \
    mv composer.phar /usr/local/bin/composer ;

COPY . /var/www/html

RUN php /var/www/html/bin/console cache:warmup -vv --env=prod \
    && chown -R www-data:www-data /var/www/html/var



