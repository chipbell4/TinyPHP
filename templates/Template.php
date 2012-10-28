<?php

require_once('/var/www/html/paste/config.php');

class Template
{
	public static function renderTemplateWithContext($templateName, 
		$variables = array())
	{
		$templateFullPath = TEMPLATES . $templateName;

		foreach($variables as $key => $value)
		{
			if(strlen($key) > 0)
				${$key} = $value;
		}
		require_once(TEMPLATES . 'header.php');
		require_once($templateFullPath);
		require_once(TEMPLATES . 'footer.php');
	}
}
?>
