<?php
require_once(__DIR__ . '/config.php');
require_once(DB . '/connection.php');
require_once(TEMPLATES . 'Template.php');

$context = array("n" => 20);
Template::renderTemplateWithContext('sampleTemplate.php', $context);
?>
