FROM wordpress:cli-2.3.0-php7.1

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install Git, unzip, apt-utils and nano
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends unzip apt-utils nano;

# Create configuration file for configuration test.
# Copy the configuration file of suite
COPY codeception/init_config.suite.yml /usr/src/wordpress/codeception/init_config.suite.yml

# Copy the test file
COPY codeception/initConfigCest.php /usr/src/wordpress/codeception/initConfigCest.php

# Modify the docker-entrypoint.sh file from WordPress docker and add a little modification
COPY modify_docker-entrypoint.php /usr/src/wordpress/modify_docker-entrypoint.php

RUN set -eux; \
    php -f /usr/src/wordpress/modify_docker-entrypoint.php; \
    rm /usr/src/wordpress/modify_docker-entrypoint.php;