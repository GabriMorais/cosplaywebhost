<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');
require('vendor/autoload.php');
define('INCLUDE_PATH_STATIC','https://redesocialcosplay.000webhostapp.com/RedeSocialCosplay/Views/pages/');
define('INCLUDE_PATH','https://redesocialcosplay.000webhostapp.com/');
$app = new RedeSocialCosplay\Aplicacao();
$app->run();

?>
