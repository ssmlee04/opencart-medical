<?php
// Version
define('VERSION', '1.5.6.4');

// Configuration
if (file_exists('config.php')) {
	require_once('config.php');
}

// Install
if (!defined('DIR_APPLICATION')) {
	header('Location: ../install/index.php');
	exit;
}

// vQmod
require_once('./vqmod/vqmod.php');
VQMod::bootup();

// VQMODDED Startup
require_once(VQMod::modCheck(DIR_SYSTEM . 'startup.php'));

// Application Classes
require_once(VQMod::modCheck(DIR_SYSTEM . 'library/user.php'));
require_once(VQMod::modCheck(DIR_SYSTEM . 'library/currency.php'));
require_once(VQMod::modCheck(DIR_SYSTEM . 'library/tax.php'));
require_once(VQMod::modCheck(DIR_SYSTEM . 'library/weight.php'));
require_once(VQMod::modCheck(DIR_SYSTEM . 'library/length.php'));
require_once(VQMod::modCheck(DIR_SYSTEM . 'library/cart.php'));
require_once(VQMod::modCheck(DIR_SYSTEM . 'library/customer.php'));


// VirtualQMOD
require_once('./vqmod/vqmod.php');
VQMod::bootup();

// VQMODDED Startup
//require_once(VQMod::modCheck(DIR_SYSTEM . 'startup.php'));

// Application Classes
//require_once(VQMod::modCheck(DIR_SYSTEM . 'library/tax.php'));
//require_once(VQMod::modCheck(DIR_SYSTEM . 'library/currency.php'));
//require_once(VQMod::modCheck(DIR_SYSTEM . 'library/user.php'));
//require_once(VQMod::modCheck(DIR_SYSTEM . 'library/weight.php'));
//require_once(VQMod::modCheck(DIR_SYSTEM . 'library/length.php'));
//require_once(VQMod::modCheck(DIR_SYSTEM . 'library/customer.php'));
//require_once(VQMod::modCheck(DIR_SYSTEM . 'library/cart.php'));

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Config
$config = new Config();
$registry->set('config', $config);

// Database
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);

// Settings
$query = $db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '0'");

foreach ($query->rows as $setting) {
	if (!$setting['serialized']) {
		$config->set($setting['key'], $setting['value']);
	} else {
		$config->set($setting['key'], unserialize($setting['value']));
	}
}

// Url
$url = new Url(HTTP_SERVER, $config->get('config_secure') ? HTTPS_SERVER : HTTP_SERVER);	
$registry->set('url', $url);

// Log
$log = new Log($config->get('config_error_filename'));
$registry->set('log', $log);

function error_handler($errno, $errstr, $errfile, $errline) {
	global $log, $config;
	
	switch ($errno) {
		case E_NOTICE:
		case E_USER_NOTICE:
			$error = 'Notice';
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$error = 'Warning';
			break;
		case E_ERROR:
		case E_USER_ERROR:
			$error = 'Fatal Error';
			break;
		default:
			$error = 'Unknown';
			break;
	}
		
	if ($config->get('config_error_display')) {
		echo '<b>' . $error . '</b>: ' . $errstr . ' in <b>' . $errfile . '</b> on line <b>' . $errline . '</b>';
	}
	
	if ($config->get('config_error_log')) {
		$log->write('PHP ' . $error . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
	}

	return true;
}

// Error Handler
set_error_handler('error_handler');

// Request
$request = new Request();
$registry->set('request', $request);

// Response
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$registry->set('response', $response); 

// Cache
$cache = new Cache();
$registry->set('cache', $cache); 

// Session
$session = new Session();
$registry->set('session', $session); 

// Language
$languages = array();

$query = $db->query("SELECT * FROM `" . DB_PREFIX . "language`"); 

foreach ($query->rows as $result) {
	$languages[$result['code']] = $result;
}

$config->set('config_language_id', $languages[$config->get('config_admin_language')]['language_id']);

// Language	
$language = new Language($languages[$config->get('config_admin_language')]['directory']);
$language->load($languages[$config->get('config_admin_language')]['filename']);	
$registry->set('language', $language);

// Customer
$registry->set('customer', new Customer($registry));

// Tax
$registry->set('tax', new Tax($registry));

// Document
$registry->set('document', new Document()); 		

// Currency
$registry->set('currency', new Currency($registry));		

// Cart
$registry->set('cart', new Cart($registry));

// Weight
$registry->set('weight', new Weight($registry));

// Length
$registry->set('length', new Length($registry));

// User
$registry->set('user', new User($registry));

//OpenBay Pro
$registry->set('openbay', new Openbay($registry));

// Front Controller
$controller = new Front($registry);

// Login
$controller->addPreAction(new Action('common/home/login'));

// Permission
$controller->addPreAction(new Action('common/home/permission'));

// Router
if (isset($request->get['route'])) {
	$action = new Action($request->get['route']);
} else {
	$action = new Action('common/home');
}

// Dispatch
$controller->dispatch($action, new Action('error/not_found'));

// Output
$response->output();

$file = 'people.txt';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current = print_r(array(1,2,3,4, 5, 6, 7), true);
		// Write the contents back to the file
		file_put_contents($file, $current);

?>
