<?php
// HTTP

// $NODE_ENV = getenv('NODE_ENV');
$NODE_ENV = 'opencart2';
$WEBSITE_ENV = 'localhost';
$RELPATH = '/var/www/html';

define('HTTP_SERVER', 'http://' . $WEBSITE_ENV . '/' . $NODE_ENV . '/');
define('HTTP_CATALOG', 'http://' . $WEBSITE_ENV .'/' . $NODE_ENV . '/');

// HTTPS
define('HTTPS_SERVER', 'http://' . $WEBSITE_ENV . '/' . $NODE_ENV . '/');
define('HTTPS_CATALOG', 'http://' . $WEBSITE_ENV . '/' . $NODE_ENV . '/');

// DIR
define('DIR_APPLICATION', $RELPATH . '/' . $NODE_ENV . '/');
define('DIR_SYSTEM', $RELPATH . '/' . $NODE_ENV . '/system/');
define('DIR_DATABASE', $RELPATH . '/' . $NODE_ENV . '/system/database/');
define('DIR_LANGUAGE', $RELPATH . '/' . $NODE_ENV . '/language/');
define('DIR_TEMPLATE', $RELPATH . '/' . $NODE_ENV . '/view/template/');
define('DIR_CONFIG', $RELPATH . '/' . $NODE_ENV . '/system/config/');
define('DIR_IMAGE', $RELPATH . '/' . $NODE_ENV . '/image/');
define('DIR_CACHE', $RELPATH . '/' . $NODE_ENV . '/system/cache/');
define('DIR_DOWNLOAD', $RELPATH . '/' . $NODE_ENV . '/download/');
define('DIR_LOGS', $RELPATH . '/' . $NODE_ENV . '/system/logs/');
define('DIR_CATALOG', $RELPATH . '/' . $NODE_ENV . '/catalog/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'aenge1012');
define('DB_DATABASE', 'opencart');
define('DB_PREFIX', 'oc_');
?>
