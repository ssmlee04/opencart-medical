<?php
// HTTP

// $NODE_ENV = getenv('NODE_ENV');
// $NODE_ENV = 'med';
$WEBSITE_ENV = 'www.maplecrab.com';
$RELPATH = '.';

define('HTTP_SERVER', 'http://' . $WEBSITE_ENV . '/');
define('HTTP_CATALOG', 'http://' . $WEBSITE_ENV .'/');

// HTTPS
define('HTTPS_SERVER', 'http://' . $WEBSITE_ENV . '/');
define('HTTPS_CATALOG', 'http://' . $WEBSITE_ENV . '/');

// DIR
define('DIR_APPLICATION', $RELPATH . '/');
define('DIR_SYSTEM', $RELPATH . '/system/');
define('DIR_DATABASE', $RELPATH . '/system/database/');
define('DIR_LANGUAGE', $RELPATH . '/language/');
define('DIR_TEMPLATE', $RELPATH . '/view/template/');
define('DIR_CONFIG', $RELPATH . '/system/config/');
define('DIR_IMAGE', $RELPATH . '/image/');
define('DIR_CACHE', $RELPATH . '/system/cache/');
define('DIR_DOWNLOAD', $RELPATH . '/download/');
define('DIR_LOGS', $RELPATH . '/system/logs/');
define('DIR_CATALOG', $RELPATH . '/catalog/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'mysql.freehostingnoads.net');
define('DB_USERNAME', 'u819040040_root');
define('DB_PASSWORD', '13572468');
define('DB_DATABASE', 'u819040040_med');
define('DB_PREFIX', 'oc_');
?>
