<?php
// error reporting
ini_set("error_reporting", "true");
error_reporting(E_ALL | E_STRICT);
	

defined('PATH_TO_APP') OR define('PATH_TO_APP', '/var/www/html/paste/');
defined('AUTH') OR define('AUTH', PATH_TO_APP . 'auth/'); 
defined('DB') OR define('DB', PATH_TO_APP . 'db/');
defined('HANDLERS') OR define('HANDLERS', PATH_TO_APP . 'handlers/');
defined('MODELS') OR define('MODELS', PATH_TO_APP . 'models/'); 
defined('RENDERERS') OR define('RENDERERS', PATH_TO_APP . 'renderers/'); 
defined('STYLE') OR define('STYLE', PATH_TO_APP . 'style/');
defined('SCRIPTS') OR define('SCRIPTS', PATH_TO_APP . 'scripts/');
defined('SQL') OR define('SQL', PATH_TO_APP . 'sql/'); 
defined('TEMPLATES') OR define('TEMPLATES', PATH_TO_APP . 'templates/'); 
?>
