# Use PHP-FPM + NGInx image
# URL: http://dockerfile.readthedocs.io/en/latest/content/DockerImages/dockerfiles/php-nginx.html
FROM webdevops/php-nginx-dev:8.0

# Add custom vhost config
COPY vhost.conf /opt/docker/etc/nginx/vhost.conf

# Switch to webroot folder and add all files into it
ADD . /app
WORKDIR /app

# Install composer
#RUN chmod +x composer-setup.sh
#RUN ./composer-setup.sh
#RUN rm composer-setup.sh

# Install packages
#ENV COMPOSER_ALLOW_SUPERUSER 1
#RUN php composer.phar install --no-progress

# Add CRON job
#COPY cron-jobs /etc/cron.d/cron-jobs
# Remove write permissions from group and other
#RUN chmod go-w /etc/cron.d/cron-jobs
# Apply job
#RUN crontab -u application /etc/cron.d/cron-jobs

