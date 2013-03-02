<?php
// error reporting
ini_set("error_reporting", "true");
error_reporting(E_ALL | E_STRICT);
	

defined('AUTH') OR define('AUTH', __DIR__ . '/auth/'); 
defined('DB') OR define('DB', __DIR__ . '/db/');
defined('HANDLERS') OR define('HANDLERS', __DIR__ . '/handlers/');
defined('MODELS') OR define('MODELS', __DIR__ . '/models/'); 
defined('RENDERERS') OR define('RENDERERS', __DIR__ . '/renderers/'); 
defined('STYLE') OR define('STYLE', __DIR__ . '/style/');
defined('SCRIPTS') OR define('SCRIPTS', __DIR__ . '/scripts/');
defined('SQL') OR define('SQL', __DIR__ . '/sql/'); 
defined('TEMPLATES') OR define('TEMPLATES', __DIR__ . '/templates/'); 
?>
