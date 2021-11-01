<?php
$search = 'fi

exec "$@"';

$replace = '    if [ ! -e installed ] && [ -e index.php ] && [ -e wp-includes/version.php ]; then'. PHP_EOL;
$replace .= '       if [ ! -e vendor/bin/codecept ]; then'.PHP_EOL;
$replace .= '           # Install Codeception'. PHP_EOL;
$replace .= '           /usr/bin/composer require codeception/codeception codeception/module-phpbrowser codeception/module-asserts --dev'. PHP_EOL;
$replace .= "           php vendor/bin/codecept bootstrap" . PHP_EOL;
//$replace .= "           php vendor/bin/codecept g:suite init_config" . PHP_EOL;
//$replace .= "           php vendor/bin/codecept generate:cest init_config initConfig" . PHP_EOL;
$replace .= "       fi".PHP_EOL;
$replace .= "       if [ ! -e vendor/bin/wp-cli/wp-cli/bin/wp ]; then". PHP_EOL;
$replace .= "           /usr/bin/composer require wp-cli/wp-cli-bundle --dev". PHP_EOL;
$replace .= '           if [ -z ${WORDPRESS_WEBSITE_TITLE+x} ]; then'. PHP_EOL;
$replace .= '               WORDPRESS_WEBSITE_TITLE="My blog"'.PHP_EOL;
$replace .= '           fi'.PHP_EOL;
$replace .= '           if [ -z ${WORDPRESS_ADMIN_USER+x} ]; then'. PHP_EOL;
$replace .= '               WORDPRESS_ADMIN_USER="admin"'.PHP_EOL;
$replace .= '           fi'.PHP_EOL;
$replace .= '           if [ -z ${WORDPRESS_ADMIN_PASSWORD+x} ]; then'. PHP_EOL;
$replace .= '               WORDPRESS_ADMIN_PASSWORD="1234"'.PHP_EOL;
$replace .= '           fi'.PHP_EOL;
$replace .= '           if [ -z ${WORDPRESS_ADMIN_EMAIL+x} ]; then'. PHP_EOL;
$replace .= '               WORDPRESS_ADMIN_EMAIL="foo@bar.com"'.PHP_EOL;
$replace .= '           fi'.PHP_EOL;
$replace .= '           if [ -z ${WORDPRESS_URL+x} ]; then'. PHP_EOL;
$replace .= '               WORDPRESS_URL="http://localhost:8080"'.PHP_EOL;
$replace .= '           fi'.PHP_EOL;
$replace .= '           vendor/bin/wp core install --allow-root --title="${WORDPRESS_WEBSITE_TITLE}" --admin_user="${WORDPRESS_ADMIN_USER}" --admin_password="${WORDPRESS_ADMIN_PASSWORD}" --admin_email="${WORDPRESS_ADMIN_EMAIL}" --url="${WORDPRESS_URL}"'. PHP_EOL;
$replace .= "       fi" . PHP_EOL;
//$replace .= "       cp codeception/init_config.suite.yml tests/init_config.suite.yml" . PHP_EOL;
//$replace .= "       cp codeception/initConfigCest.php tests/init_config/initConfigCest.php" . PHP_EOL;
//$replace .= "       php vendor/bin/codecept build" . PHP_EOL;
//$replace .= "       php vendor/bin/codecept run init_config;". PHP_EOL;
//$replace .= '       if [ grep -Fxq "WordPress has been installed. Thank you, and enjoy!" tests/_output/debug/installed.html ]; then'. PHP_EOL;
$replace .= '           echo "1" > installed'. PHP_EOL;
//$replace .= '       fi'.PHP_EOL;
$replace .= '   fi'. PHP_EOL;


$filename = '/usr/local/bin/docker-entrypoint.sh';
$content = file_get_contents($filename);

$content = str_replace($search, $replace.$search, $content);

file_put_contents($filename,$content);
