<?php
// HTTP

// $NODE_ENV = getenv('NODE_ENV');
$NODE_ENV = 'opencart2';
$WEBSITE_ENV = 'localhost';

define('HTTP_SERVER', 'http://' . $WEBSITE_ENV . '/' . $NODE_ENV . '/');
define('HTTP_CATALOG', 'http://' . $WEBSITE_ENV .'/' . $NODE_ENV . '/');

// HTTPS
define('HTTPS_SERVER', 'http://localhost/' . $NODE_ENV . '/');
define('HTTPS_CATALOG', 'http://localhost/' . $NODE_ENV . '/');

// DIR
define('DIR_APPLICATION', '/var/www/html/' . $NODE_ENV . '/');
define('DIR_SYSTEM', '/var/www/html/' . $NODE_ENV . '/system/');
define('DIR_DATABASE', '/var/www/html/' . $NODE_ENV . '/system/database/');
define('DIR_LANGUAGE', '/var/www/html/' . $NODE_ENV . '/language/');
define('DIR_TEMPLATE', '/var/www/html/' . $NODE_ENV . '/view/template/');
define('DIR_CONFIG', '/var/www/html/' . $NODE_ENV . '/system/config/');
define('DIR_IMAGE', '/var/www/html/' . $NODE_ENV . '/image/');
define('DIR_CACHE', '/var/www/html/' . $NODE_ENV . '/system/cache/');
define('DIR_DOWNLOAD', '/var/www/html/' . $NODE_ENV . '/download/');
define('DIR_LOGS', '/var/www/html/' . $NODE_ENV . '/system/logs/');
define('DIR_CATALOG', '/var/www/html/' . $NODE_ENV . '/catalog/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'aenge1012');
define('DB_DATABASE', 'opencart');
define('DB_PREFIX', 'oc_');
?>
